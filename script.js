// JavaScript for Theme Toggle and Chatbot Functionality

function toggleTheme() {
    const body = document.body;
    body.classList.toggle('dark-mode');
    const isDarkMode = body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
}

// Check for stored theme preference
document.addEventListener('DOMContentLoaded', () => {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }});

    document.addEventListener("DOMContentLoaded", function () {
        fetch('shop.php?action=getProducts')
            .then(response => response.json())
            .then(products => {
                const sliderContainer = document.getElementById('shop-slider');
                
                products.forEach(product => {
                    const productItem = document.createElement('div');
                    productItem.className = 'product-box';
                    productItem.innerHTML = `
                        <div class="product-image">
                            <img src="${product.image}" alt="${product.name}">
                        </div>
                        <h3>${product.name}</h3>
                        <p class="product-price">$${product.price}</p>
                        <button class="add-to-cart">🛒 Add to Cart</button>
                    `;
                    sliderContainer.appendChild(productItem);
                });
    
                // Initialize Tiny Slider
                let slider = tns({
                    container: '#shop-slider',
                    items: 1, // Show only one product at a time
                    slideBy: 1,
                    autoplay: false,
                    speed: 500,
                    autoplayButtonOutput: false,
                    controls: true,
                    nav: false,
                    mouseDrag: true,
                    controlsContainer: "#custom-controls", // Custom buttons
                });
            })
            .catch(error => console.error("Error loading products:", error));
    });
    
    /* Chatbot Toggle Button
    const chatbotIcon = document.createElement('img');
    chatbotIcon.src = 'assets/panda(2).jpg';
    chatbotIcon.style.position = 'fixed';
    chatbotIcon.style.bottom = '20px';
    chatbotIcon.style.right = '20px';
    chatbotIcon.style.width = '100px';
    chatbotIcon.style.cursor = 'pointer';
    document.body.appendChild(chatbotIcon);

    // Chatbot Box
    const chatbotBox = document.createElement('div');
    chatbotBox.id = 'chatbot-box';
    chatbotBox.style.position = 'fixed';
    chatbotBox.style.bottom = '100px';
    chatbotBox.style.right = '20px';
    chatbotBox.style.width = '300px';
    chatbotBox.style.height = '400px';
    chatbotBox.style.background = '#fff';
    chatbotBox.style.border = '1px solid #ccc';
    chatbotBox.style.borderRadius = '10px';
    chatbotBox.style.boxShadow = '0px 4px 10px rgba(0,0,0,0.1)';
    chatbotBox.style.padding = '10px';
    chatbotBox.style.display = 'none';
    chatbotBox.innerHTML = `
        <div style="text-align: center; font-weight: bold;">Panda Chatbot</div>
        <div id="chatbot-messages" style="height: 300px; overflow-y: auto; padding: 5px;"></div>
        <input type="text" id="chat-input" placeholder="Ask me anything..." style="width: 100%; padding: 5px;">
        <button id="chat-button" style="width: 100%; padding: 5px;">Send</button>
    `;
    document.body.appendChild(chatbotBox);

    // Click to Open/Close Chatbot
    chatbotIcon.addEventListener('click', () => {
        chatbotBox.style.display = chatbotBox.style.display === 'none' ? 'block' : 'none';
    });

    // Chatbot Functionality
    const chatInput = document.getElementById('chat-input');
    const chatButton = document.getElementById('chat-button');
    const chatMessages = document.getElementById('chatbot-messages');

    chatButton.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });

    function sendMessage() {
        const message = chatInput.value.trim();
        if (message !== '') {
            appendMessage('User: ' + message);
            chatInput.value = '';
            setTimeout(() => appendMessage('Panda: ' + generateResponse(message)), 500);
        }
    }

    function appendMessage(text) {
        const messageElement = document.createElement('p');
        messageElement.textContent = text;
        chatMessages.appendChild(messageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function generateResponse(message) {
        const lowerMsg = message.toLowerCase();
        
        if (lowerMsg.includes('diet')) {
            return 'I can help you create a diet plan! Would you like vegetarian, non-veg, or vegan options?';
        } else if (lowerMsg.includes('workout')) {
            return 'Tell me your fitness goal: Strength, Cardio, or Weight Loss? I will generate a plan for you!';
        } else if (lowerMsg.includes('shop') || lowerMsg.includes('buy')) {
            return 'Looking to shop? Visit our store section for the best fitness products!';
        } else if (lowerMsg.includes('cart')) {
            return 'Need help with your cart? You can view your cart and proceed to checkout anytime!';
        } else if (lowerMsg.includes('checkout') || lowerMsg.includes('payment')) {
            return 'Ready to purchase? Click on the checkout button to complete your order!';
        } else if (lowerMsg.includes('wellness')) {
            return 'Wellness is important! Would you like mindfulness exercises or mental health tips?';
        } else {
            return 'I am your AI fitness assistant! Ask me about workouts, diet, shopping, wellness, or anything on this website!';
        }
    }
});
*/
