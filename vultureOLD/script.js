document.addEventListener('DOMContentLoaded', function() {

    
    const imageDropdowns = document.querySelectorAll('.image-name');

    function isIntegerName(name) {
        return /^\d+$/.test(name.split('.')[0]);
    }
    
    function isAlphanumericName(name) {
        return /^[a-zA-Z0-9]+$/.test(name.split('.')[0]);
    }
    
    function insertOptionInOrder(dropdown, newOption) {
        const options = Array.from(dropdown.options);
        const integerOptions = options.filter(opt => isIntegerName(opt.value));
        const nonIntegerOptions = options.filter(opt => !isIntegerName(opt.value));
        
        if (isIntegerName(newOption.value)) {
            const insertIndex = integerOptions.findIndex(opt => parseInt(opt.value) > parseInt(newOption.value));
            if (insertIndex === -1) {
                dropdown.add(newOption, nonIntegerOptions[0] || null);
            } else {
                dropdown.add(newOption, integerOptions[insertIndex]);
            }
        } else {
            dropdown.add(newOption);
        }
    }
    
    function updateDropdowns(folder, oldName, newName, currentDropdown) {
        imageDropdowns.forEach(dropdown => {
            if (dropdown.dataset.folder === folder && dropdown !== currentDropdown) {
                const option = dropdown.querySelector(`option[value="${newName}"]`);
                if (option) {
                    option.remove();
                }
                
                if (!isIntegerName(oldName)) {
                    const newOption = document.createElement('option');
                    newOption.value = oldName.split('.')[0];
                    newOption.textContent = oldName.split('.')[0];
                    insertOptionInOrder(dropdown, newOption);
                }
            }
        });
    }
    
    function updateGildedClass(dropdown, newName) {
        const imageCard = dropdown.closest('.image-card');
        if (isAlphanumericName(newName) && !isIntegerName(newName)) {
            dropdown.classList.add('gilded');
            if (imageCard) imageCard.classList.add('gilded');
        } else {
            dropdown.classList.remove('gilded');
            if (imageCard) imageCard.classList.remove('gilded');
        }
    }
    
    imageDropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            const folder = this.dataset.folder;
            const oldName = this.dataset.original;
            const newName = this.value;
    
            console.log('Dropdown changed:', { folder, oldName, newName });
    
            // Send AJAX request to rename the file
            renameFile(folder, oldName, newName)
                .then(response => {
                    if (response.success) {
                        // Update the current dropdown's data-original attribute
                        this.dataset.original = newName + '.' + oldName.split('.').pop();
                        
                        // Update gilded class
                        updateGildedClass(this, newName);
                        
                        // Update other dropdowns in the same folder
                        updateDropdowns(folder, oldName, newName, this);
                    } else {
                        console.error('Failed to rename file:', response.message);
                        alert(response.message);
                        // Revert the dropdown to its original value
                        this.value = oldName.split('.')[0];
                    }
                })
                .catch(error => {
                    console.error('Error renaming file:', error);
                    alert('An unexpected error occurred.');
                    // Revert the dropdown to its original value
                    this.value = oldName.split('.')[0];
                });
        });
    });

    document.querySelectorAll('.add-deck-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var folder = this.getAttribute('data-folder');
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'addNewDeck.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert('New deck added successfully!');
                            location.reload(); // Refresh the page
                        } else {
                            alert('Failed to add new deck: ' + response.message);
                        }
                    } else {
                        alert('An error occurred while adding the new deck.');
                    }
                }
            };
    
            xhr.send('folder=' + encodeURIComponent(folder));
        });
    });
    

    function renameFile(folder, oldName, newName) {
        return fetch('rename_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `rename_file=1&folder=${encodeURIComponent(folder)}&old_name=${encodeURIComponent(oldName)}&new_name=${encodeURIComponent(newName)}`,
        })
        .then(response => response.json());
    }

    function renameFolder(oldName, newName) {
        return fetch('rename_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `rename_folder=1&old_name=${encodeURIComponent(oldName)}&new_name=${encodeURIComponent(newName)}`,
        })
        .then(response => response.json());
    }
});
