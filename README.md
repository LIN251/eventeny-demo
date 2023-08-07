# Marketplace Website

This is a simple marketplace website where users can buy and sell products. Below are some of the key features of this project:

## Setup

1. Clone project.

2. Update all required fields in the .env file.

## Key Features

1. **Product Listings**: The marketing page displays all products currently available for sale from various admin users.

2. **Admin Product Management**:
   - Admin can create, read, update, and delete items/products in the system.
   - Products can be added with details such as name, price, description, availability, and return policy.

3. **Admin Registration and Login**:
   - Admin can register a new account with a unique username.
   - Admin can securely log in to the system using their registered credentials.

4. **Guest Purchase**:
   - Guests (non-registered users) can make purchases from the available products.
   - Guests can provide their name, email, shipping address, and payment details during the purchase process.

5. **Product Archive (Template)**:
   - Archived products are no longer available for purchase.
   - Archived products are kept for historical reference but are no longer displayed in the main product listing.

6. **Discount Management**:
   - Admin can apply discounts to specific products or categories.
   - Discounts can be set as a percentage off base on the original price.

7. **Email Confirmation**:
   - Users receive email confirmation upon successful registration.
   - Customers receive email receipts after making a purchase.
   - Automated emails are sent to users, but they end up in the **Spam folder**.

8. **Purchase Page**:
   - Users can add products to their shopping cart for purchase.

9. **Shipping Management**:
   - Admin can manage shipping status.

10. **Private Archiving**:
    - Archived products are hidden from the public product list, providing a clutter-free and user-friendly experience for potential buyers.

11. **Earnings Tracking**:
    - Admin can track earnings for each product sold.
    - The system calculates earnings as the difference between the sell price and the product's cost price.

12. **Seller Contact Information**:
    - Each product listing includes the seller's email, making it easy for potential buyers to contact them directly.
    - Purchases will be made as guests.

13. **User-Specific Product List**:
    - Upon logging in, each admin user has access to their own product list, where they can manage their product listings.

14. **Out of Stock Handling**:
    - Products with zero availability are clearly marked as "Out of Stock" to inform buyers about their unavailability.

15. **Input Validation**:
    - The application performs thorough validation to ensure that no empty values are allowed when adding or editing products.

16. **Checkbox Locking**:
    - Once a product is marked as shipped, the checkbox is locked to prevent accidental changes.

17. **Multiple Rows for Purchases**:
    - When multiple items are purchased in a single transaction, individual rows are displayed on the "Sold" page, maintaining a clear record of each sold item.



## Database Schema

![Database Schema](https://drive.google.com/file/d/1k6Ck5Lm6OiELjyU245184QfQR-awwaW5/view?usp=drive_link)

1. **Automatic Table Creation**: The application automatically creates necessary SQL tables (users, products, purchases) if they do not already exist.

2. **Fake Data for Testing**: For testing purposes, the database includes some pre-populated data, such as admin and test user accounts, as well as product listings.

   - Admin Username: **admin**, Password: **admin**
   - Test User Username: **testuser**, Password: **testuser**
   - Products: iPhone, iPad, MacBook, Apple TV, AirPods

---

This README provides a brief overview of the key functionalities of the marketplace website. 

Happy trading in the marketplace! 😊

## Marketplace Image
![marketplace1](https://drive.google.com/file/d/16EHJI7ietZYV4P5w44O6vWt2RyeuNlUb/view?usp=drive_link)

![Marketplace2](https://drive.google.com/file/d/1qGHxo9XkenXrIhSQitNAEb_WUbGHqlRF/view?usp=drive_link)

![Marketplace3](https://drive.google.com/file/d/16ooXzhHZ-PQXACYSjA_uKob2k7SoQ9WW/view?usp=drive_link)

![Marketplace4](https://drive.google.com/file/d/1_1Cwlm56TybJTBmoDU_xmaw1LaS1Tspl/view?usp=drive_link)

## Admin Image
![Admin1](https://drive.google.com/file/d/18j5EpnzcYFlsZZgd5L5SZpCVtIp8dXAA/view?usp=sharing)

![Admin2](https://drive.google.com/file/d/1bkf4ZGqb9EJYuyUZZuXZ9vX02p_NLtq6/view?usp=sharing)

![Admin3](https://drive.google.com/file/d/15YAhyiQgAiNaxz6mP3aTBOYdrEoYyQnu/view?usp=sharing)


