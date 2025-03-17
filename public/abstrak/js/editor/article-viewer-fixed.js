/**
 * Article Viewer with EditorJS
 * This script initializes EditorJS to display article content
 */
document.addEventListener('DOMContentLoaded', function() {
    // Check if container element exists
    const editorContainer = document.getElementById('editorjs-container');
    if (!editorContainer) return;

    // Get article data from data-content attribute
    let articleContent = {};
    try {
        if (editorContainer.dataset.content) {
            articleContent = JSON.parse(editorContainer.dataset.content);
            
            // Debug: Log the parsed content
            console.log('Parsed article content:', articleContent);
            
            // Check if the content has the correct structure
            if (!articleContent.blocks || !Array.isArray(articleContent.blocks)) {
                // If content is not in EditorJS format, create a proper structure
                articleContent = {
                    time: new Date().getTime(),
                    blocks: [
                        {
                            type: 'paragraph',
                            data: {
                                text: editorContainer.dataset.fallbackContent || String(articleContent)
                            }
                        }
                    ],
                    version: '2.22.2'
                };
                console.log('Created default EditorJS structure:', articleContent);
            }
        }
    } catch (error) {
        console.error('Error parsing article content:', error);
        // Create default content structure
        articleContent = {
            time: new Date().getTime(),
            blocks: [
                {
                    type: 'paragraph',
                    data: {
                        text: editorContainer.dataset.fallbackContent || 'No content available'
                    }
                }
            ],
            version: '2.22.2'
        };
    }

    // Define global editor variables
    let editor;
    let isReadOnly = true;

    // Initialize EditorJS in read-only mode
    try {
        editor = new EditorJS({
            holder: 'editorjs-container',
            tools: {
                // EditorJS tools can be added here when needed
                // Example: header: Header, list: List, etc.
            },
            data: articleContent,
            readOnly: isReadOnly,
            minHeight: 0,
            onReady: () => {
                console.log('Editor.js is ready to work!');
                console.log('Current data:', articleContent);
            }
        });
    } catch (error) {
        console.error('Error initializing EditorJS:', error);
        // Display content as plain text if EditorJS fails
        if (editorContainer.dataset.fallbackContent) {
            editorContainer.innerHTML = editorContainer.dataset.fallbackContent;
        }
    }

    // Add event listener for the edit article button
    const editButton = document.getElementById('edit-article-button');
    if (editButton && editor) {
        editButton.addEventListener('click', function(e) {
            e.preventDefault();

            // Toggle read-only mode
            isReadOnly = !isReadOnly;
            
            // Reinitialize editor with new mode
            editor.readOnly.toggle();
            
            // Change button text based on mode
            if (isReadOnly) {
                editButton.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
                // Hide save button if it exists
                const saveButton = document.getElementById('save-article-button');
                if (saveButton) saveButton.style.display = 'none';
            } else {
                editButton.innerHTML = '<i class="fa-regular fa-rectangle-xmark"></i>';
                // Show save button if it exists
                const saveButton = document.getElementById('save-article-button');
                if (saveButton) saveButton.style.display = 'inline-block';
            }
            
            console.log('Editor mode changed to: ' + (isReadOnly ? 'read-only' : 'edit'));
        });
    }
    
    // Add event listener for the save article button
    const saveButton = document.getElementById('save-article-button');
    if (saveButton && editor) {
        saveButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show loading state
            saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            saveButton.disabled = true;
            
            // Get editor data
            editor.save().then((outputData) => {
                // Log complete outputData to console
                console.log('EditorJS Output Data:');
                console.log(outputData);
                console.log('EditorJS Output Data (JSON string):');
                console.log(JSON.stringify(outputData, null, 2));
                
                // Send data to server
                const articleId = saveButton.dataset.articleId;
                const saveUrl = saveButton.dataset.saveUrl;
                
                fetch(saveUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        content: outputData,
                        _method: 'PUT'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reset editor to read-only mode
                        isReadOnly = true;
                        editor.readOnly.toggle();
                        
                        // Update UI
                        editButton.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
                        saveButton.style.display = 'none';
                        
                        // Show success message
                        const messageElement = document.createElement('div');
                        messageElement.className = 'alert alert-success mt-3';
                        messageElement.textContent = 'Article saved successfully!';
                        editorContainer.parentNode.insertBefore(messageElement, editorContainer.nextSibling);
                        
                        // Remove message after 3 seconds
                        setTimeout(() => {
                            messageElement.remove();
                        }, 3000);
                    } else {
                        alert('Error saving article: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    console.error('Error saving article:', error);
                    alert('Error saving article. Please try again.');
                })
                .finally(() => {
                    // Reset button state
                    saveButton.innerHTML = 'Save Changes';
                    saveButton.disabled = false;
                });
            }).catch(error => {
                console.error('Error getting editor data:', error);
                alert('Error getting editor data. Please try again.');
                saveButton.innerHTML = 'Save Changes';
                saveButton.disabled = false;
            });
        });
    }
}); 