// Pricing page specific functionality

document.addEventListener('DOMContentLoaded', function() {
    // Pricing toggle functionality
    const pricingToggle = document.getElementById('pricing-toggle');
    const monthlyPrices = document.querySelectorAll('.monthly-price');
    const annualPrices = document.querySelectorAll('.annual-price');
    const billingTexts = document.querySelectorAll('.plan-billing');
    
    if (pricingToggle) {
        pricingToggle.addEventListener('change', function() {
            const isAnnual = this.checked;
            
            monthlyPrices.forEach(price => {
                price.style.display = isAnnual ? 'none' : 'inline';
            });
            
            annualPrices.forEach(price => {
                price.style.display = isAnnual ? 'inline' : 'none';
            });
            
            billingTexts.forEach(text => {
                text.textContent = isAnnual ? 'Billed annually' : 'Billed monthly';
            });
        });
    }
    
    // Plan comparison functionality
    const planCards = document.querySelectorAll('.pricing-card');
    planCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove active class from all cards
            planCards.forEach(c => c.classList.remove('selected'));
            // Add active class to clicked card
            this.classList.add('selected');
        });
    });
    
    // FAQ accordion functionality (if not already handled in main.js)
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const faqItem = this.parentElement;
            const isActive = faqItem.classList.contains('active');
            
            // Close all FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Open clicked item if it wasn't active
            if (!isActive) {
                faqItem.classList.add('active');
            }
        });
    });
    
    // Price calculation for custom plans
    function calculateCustomPrice(patients, features) {
        let basePrice = 2999; // Basic plan price
        
        if (patients > 50) {
            basePrice += Math.ceil((patients - 50) / 50) * 1000;
        }
        
        if (features.includes('advanced-analytics')) {
            basePrice += 1000;
        }
        
        if (features.includes('custom-branding')) {
            basePrice += 500;
        }
        
        if (features.includes('api-access')) {
            basePrice += 1500;
        }
        
        return basePrice;
    }
    
    // Plan recommendation based on user input
    function recommendPlan(userNeeds) {
        const { patients, features, budget } = userNeeds;
        
        if (patients <= 50 && budget < 5000) {
            return 'basic';
        } else if (patients <= 200 && budget < 10000) {
            return 'pro';
        } else {
            return 'clinic';
        }
    }
    
    // Animate price changes
    function animatePriceChange(element, newPrice) {
        element.style.transform = 'scale(1.1)';
        element.style.color = 'var(--primary-color)';
        
        setTimeout(() => {
            element.textContent = newPrice;
            element.style.transform = 'scale(1)';
        }, 150);
        
        setTimeout(() => {
            element.style.color = '';
        }, 300);
    }
    
    // Handle plan selection
    const planButtons = document.querySelectorAll('.plan-cta .btn');
    planButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const planCard = this.closest('.pricing-card');
            const planName = planCard.querySelector('.plan-name').textContent;
            
            // Store selected plan in localStorage
            localStorage.setItem('selectedPlan', planName.toLowerCase());
            
            // Add loading state
            this.classList.add('loading');
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Redirecting...';
        });
    });
    
    // Currency conversion (if needed)
    const currencyRates = {
        'USD': 0.012,
        'EUR': 0.011,
        'GBP': 0.0095
    };
    
    function convertCurrency(amount, fromCurrency, toCurrency) {
        if (fromCurrency === 'INR' && currencyRates[toCurrency]) {
            return Math.round(amount * currencyRates[toCurrency]);
        }
        return amount;
    }
    
    // Feature comparison tooltip
    const featureItems = document.querySelectorAll('.plan-features li');
    featureItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            const featureText = this.textContent.trim();
            showFeatureTooltip(this, featureText);
        });
        
        item.addEventListener('mouseleave', function() {
            hideFeatureTooltip();
        });
    });
    
    function showFeatureTooltip(element, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'feature-tooltip';
        tooltip.textContent = getFeatureDescription(text);
        
        document.body.appendChild(tooltip);
        
        const rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + 'px';
        tooltip.style.top = (rect.top - tooltip.offsetHeight - 10) + 'px';
        
        setTimeout(() => tooltip.classList.add('show'), 10);
    }
    
    function hideFeatureTooltip() {
        const tooltip = document.querySelector('.feature-tooltip');
        if (tooltip) {
            tooltip.classList.remove('show');
            setTimeout(() => document.body.removeChild(tooltip), 200);
        }
    }
    
    function getFeatureDescription(feature) {
        const descriptions = {
            'Up to 50 patients': 'Manage up to 50 patient records with basic features',
            'AI diet recommendations': 'Personalized diet plans generated by our AI engine',
            'Food database access': 'Access to our comprehensive Ayurvedic food database',
            'Advanced analytics': 'Detailed insights and reports on patient progress',
            'Custom branding': 'White-label solution with your clinic branding',
            'API access': 'Integrate with your existing systems via our API'
        };
        
        return descriptions[feature] || 'Learn more about this feature';
    }
    
    // Plan comparison modal
    const compareButton = document.querySelector('.compare-plans');
    if (compareButton) {
        compareButton.addEventListener('click', function() {
            showComparisonModal();
        });
    }
    
    function showComparisonModal() {
        const modal = document.createElement('div');
        modal.className = 'comparison-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Plan Comparison</h3>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Comparison table content -->
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Close modal functionality
        modal.querySelector('.close-modal').addEventListener('click', () => {
            document.body.removeChild(modal);
        });
        
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                document.body.removeChild(modal);
            }
        });
    }
});