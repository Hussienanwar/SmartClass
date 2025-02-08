// Get Element
let newChat = document.querySelector('.newChat');
let chatBox = document.querySelector('.chat-box');

// Event Listener for new chat button (to toggle the chat box)
newChat.addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent click on newChat from closing the chatBox immediately
    chatBox.classList.toggle('active');
});

// Event Listener for clicks anywhere on the document (to close the chat box)
document.addEventListener('click', function(event) {
    if (chatBox.classList.contains('active')) { // Only close if it's currently active
        chatBox.classList.remove('active');
    }
});

// Optional: Close on outside click of chatbox itself
chatBox.addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent click inside chatbox from closing it
});

const searchInput = document.querySelector('.search-name');
const chatList = document.querySelector('.chat-box ul');
const chatItems = chatList.querySelectorAll('li');

searchInput.addEventListener('input', (event) => {
    const searchTerm = event.target.value.toLowerCase();

    chatItems.forEach(item => {
    const nameElement = item.querySelector('.name');
    if (!nameElement) return;

    const name = nameElement.textContent.toLowerCase();

    if (searchTerm === "") { // If search is empty, show all elements
        item.style.display = 'flex';
        return;
    }
    // Show the chat item if its name contains the search term
    if (name.includes(searchTerm)) {
        item.style.display = 'flex';
    } else {
        item.style.display = 'none';
    }
    });
});