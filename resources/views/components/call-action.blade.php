<div class="input-group">
    @csrf
    <input type="tel" name="mobile" id="mobile-{{ $id }}" class="form-control" placeholder=" شماره موبایل" required>
    <button id="callActionButton{{ $id }}" class="subscribe-btn" type="submit">{{ $buttonText }}</button>
</div>

<!-- نوتیفیکیشن -->
<div id="notification" class="notification" style="display: none;"></div>

<style>
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 4px;
        z-index: 1000;
        max-width: 350px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .success {
        background-color: #4CAF50;
        color: white;
    }
    .error {
        background-color: #f44336;
        color: white;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const notification = document.getElementById('notification');
        

        document.getElementById('callActionButton{{ $id }}').addEventListener('click', function(e) {
            e.preventDefault();

            
            const mobile = document.getElementById('mobile-{{ $id }}').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // اعتبارسنجی ساده در سمت کلاینت
            if (!mobile || mobile.length < 10) {
                showNotification('لطفاً شماره موبایل معتبر وارد کنید.', 'error');
                return;
            }
            
            // ارسال درخواست AJAX
            fetch('{{ route('call.request') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    mobile: mobile
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                    // form.reset();
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('خطایی رخ داد. لطفاً دوباره تلاش کنید.', 'error');
            });
        });
        
        // نمایش نوتیفیکیشن
        function showNotification(message, type) {
            notification.textContent = message;
            notification.className = 'notification ' + type;
            notification.style.display = 'block';
            
            // پنهان کردن نوتیفیکیشن بعد از 5 ثانیه
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.style.display = 'none';
                    notification.style.opacity = '1';
                }, 500);
            }, 5000);
        }
    });
</script>