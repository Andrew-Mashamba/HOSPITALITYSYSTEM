# WhatsApp Message Templates

This document outlines the WhatsApp message templates that need to be created and approved in Facebook Business Manager before the WhatsApp integration can be fully operational.

## Template Overview

All templates must be created in Facebook Business Manager and approved by Meta before use. Each template has a specific purpose in the guest journey.

## Required Templates

### 1. Welcome Message (First-time Guest)
**Template Name:** `welcome_message`
**Category:** UTILITY
**Language:** English

**Content:**
```
Welcome to Sea Cliff! 🌊

You're seated at {{1}}. Let's get started with our delicious menu!

Reply with:
- MENU to view our full menu
- HELP for assistance
```

**Variables:**
- {{1}} = Table name

---

### 2. Welcome Back (Returning Guest)
**Template Name:** `welcome_back`
**Category:** UTILITY
**Language:** English

**Content:**
```
Welcome back {{1}}! 🎉

You're at {{2}}. Ready to order your favorites?

You have {{3}} loyalty points!

Reply MENU to browse or ORDER to repeat your last order.
```

**Variables:**
- {{1}} = Guest name
- {{2}} = Table name
- {{3}} = Loyalty points

---

### 3. Order Received
**Template Name:** `order_received`
**Category:** UTILITY
**Language:** English

**Content:**
```
Order Confirmed! ✅

Order #{{1}}
Table: {{2}}
Items: {{3}}
Total: TZS {{4}}

Your order has been sent to the kitchen. Estimated time: {{5}} minutes.
```

**Variables:**
- {{1}} = Order ID
- {{2}} = Table name
- {{3}} = Number of items
- {{4}} = Total amount
- {{5}} = Estimated preparation time

---

### 4. Order Preparing
**Template Name:** `order_preparing`
**Category:** UTILITY
**Language:** English

**Content:**
```
Kitchen Update 👨‍🍳

Your order #{{1}} is now being prepared!

Your food will be ready soon. Thank you for your patience!
```

**Variables:**
- {{1}} = Order ID

---

### 5. Order Ready
**Template Name:** `order_ready`
**Category:** UTILITY
**Language:** English

**Content:**
```
Order Ready! 🍽️

Your order #{{1}} is ready!

Your waiter will serve it shortly. Enjoy your meal!
```

**Variables:**
- {{1}} = Order ID

---

### 6. Running Bill
**Template Name:** `running_bill`
**Category:** UTILITY
**Language:** English

**Content:**
```
Current Bill 📄

Table: {{1}}

Subtotal: TZS {{2}}
Tax (18%): TZS {{3}}
Service (5%): TZS {{4}}

Total: TZS {{5}}

Reply BILL when ready to pay.
```

**Variables:**
- {{1}} = Table name
- {{2}} = Subtotal
- {{3}} = Tax amount
- {{4}} = Service charge
- {{5}} = Total amount

---

### 7. Final Bill
**Template Name:** `final_bill`
**Category:** UTILITY
**Language:** English

**Content:**
```
Final Bill 💳

Order #{{1}}
Total: TZS {{2}}

Payment options:
- CASH: Ask your waiter
- MPESA: Reply MPESA
- CARD: Reply CARD

Thank you for dining with us!
```

**Variables:**
- {{1}} = Order ID
- {{2}} = Total amount

---

### 8. Thank You
**Template Name:** `thank_you`
**Category:** UTILITY
**Language:** English

**Content:**
```
Thank You! 🙏

We hope you enjoyed your meal at Sea Cliff!

You earned {{1}} loyalty points today.
Total points: {{2}}

We look forward to serving you again soon!

Rate your experience: {{3}}
```

**Variables:**
- {{1}} = Points earned
- {{2}} = Total loyalty points
- {{3}} = Feedback link

---

## Setup Instructions

### Step 1: Create Facebook Business Manager Account
1. Go to https://business.facebook.com
2. Create or log into your Business Manager account
3. Add your business details

### Step 2: Apply for WhatsApp Business API
1. Navigate to WhatsApp in Business Manager
2. Apply for API access
3. Submit required documents for verification
4. Wait for approval (typically 1-2 weeks)

### Step 3: Create Message Templates
1. Go to WhatsApp Manager
2. Navigate to Message Templates
3. Create each template listed above
4. Submit for approval
5. Wait for Meta approval (typically 24-48 hours)

### Step 4: Configure Laravel App
Once approved, update your `.env` file:

```env
WHATSAPP_API_VERSION=v18.0
WHATSAPP_ACCESS_TOKEN=your_access_token_here
WHATSAPP_PHONE_NUMBER_ID=your_phone_number_id_here
WHATSAPP_BUSINESS_ACCOUNT_ID=your_business_account_id_here
WHATSAPP_WEBHOOK_VERIFY_TOKEN=seacliff_webhook_token_2024

# Restaurant Details
RESTAURANT_NAME="Sea Cliff Smart Dining"
RESTAURANT_PHONE=+255712345600
RESTAURANT_EMAIL=info@seacliff.com
```

### Step 5: Configure Webhook
1. Set webhook URL: `https://yourdomain.com/api/webhooks/whatsapp`
2. Set verify token: `seacliff_webhook_token_2024`
3. Subscribe to: `messages`, `message_status`

## Template Guidelines

### Best Practices
- Keep messages concise and clear
- Use emojis sparingly for visual appeal
- Always include actionable next steps
- Personalize with guest name when possible
- Include order/transaction IDs for tracking

### Approval Tips
- Use UTILITY category for transactional messages
- Avoid promotional language
- Don't use shortened URLs
- Ensure variables are clearly marked
- Follow Meta's message template policies

### Variable Formatting
- Always use {{1}}, {{2}}, etc. format
- Keep variable names descriptive in documentation
- Test with real data before submission

## Testing Templates

After approval, test each template:

```php
use App\Services\WhatsApp\WhatsAppService;

$whatsapp = app(WhatsAppService::class);

// Test welcome message
$whatsapp->sendTemplateMessage(
    '+255712000001',
    'welcome_message',
    ['Table 5']
);
```

## Conversation Flow States

The templates correspond to these conversation states:

1. **NEW** → Welcome Message
2. **MENU_BROWSING** → (Interactive messages, no templates)
3. **ORDERING** → (Interactive messages, no templates)
4. **ORDER_PLACED** → Order Received
5. **PREPARING** → Order Preparing
6. **READY** → Order Ready
7. **DINING** → Running Bill (on request)
8. **BILLING** → Final Bill
9. **COMPLETED** → Thank You

## Support

For WhatsApp Business API support:
- Facebook Business Help Center
- WhatsApp Business API Documentation
- Meta Developer Community

---

**Note:** This is a foundational setup. Additional templates can be created for:
- Special promotions
- Event notifications
- Menu updates
- Feedback requests
- Loyalty program updates
