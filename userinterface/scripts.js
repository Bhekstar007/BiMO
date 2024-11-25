// scripts.js

document.addEventListener("DOMContentLoaded", function() {
    const messageInput = document.getElementById("message-input");
    const sendButton = document.getElementById("send-button");
    const chatMessages = document.getElementById("chat-messages");

    function addMessage(text, isUser = true) {
        const messageElement = document.createElement("div");
        messageElement.classList.add("message");
        messageElement.classList.add(isUser ? "user-message" : "bot-message");
        messageElement.textContent = text;
        chatMessages.appendChild(messageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    async function sendMessage() {
        const userMessage = messageInput.value.trim();
        if (userMessage) {
            addMessage(userMessage, true);
            messageInput.value = "";

            const botResponse = await getBotResponse(userMessage);
            addMessage(botResponse, false);
        }
    }

    async function getBotResponse(userMessage) {
        return "I'm here to help! What would you like to know?";
    }

    sendButton.addEventListener("click", sendMessage);
    messageInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    });
});

function showPage(pageId) {
    document.querySelectorAll(".page").forEach(page => {
        page.style.display = page.id === pageId + "-container" ? "block" : "none";
    });
}

function showNotifications() {
    alert("You have no new notifications.");
}

function toggleProfileMenu() {
    const menu = document.getElementById("profile-menu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

window.addEventListener("click", function(event) {
    const profileMenu = document.getElementById("profile-menu");
    if (!event.target.matches('.profile') && profileMenu.style.display === "block") {
        profileMenu.style.display = "none";
    }
});

