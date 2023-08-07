# Marketplace Website

This is a simple marketplace website where users can buy and sell products. Below are some of the key features of this project:

## Setup

1. Clone project.

2. Update all required fields in the .env file.

## Marketing Page

1. **Product Listings**: The marketing page displays all products currently available for sale from various admin users.

2. **Seller Contact Information**: Each product listing includes the seller's email, making it easy for potential buyers to contact them directly. Purchases will be made as guests.

3. **Error Handling**: The application handles various purchase scenarios, such as preventing negative or zero purchase counts and detecting if the purchase quantity exceeds availability.

4. **Out of Stock Handling**: Products with zero availability are clearly marked as "Out of Stock" to inform buyers about their unavailability.

5. **Purchase Confirmation Email**: Buyers receive a confirmation email after completing a purchase, providing them with details of their order.
    
6. **Admin User Registration Email**: Upon successful registration, admin users receive a confirmation email welcoming them to the marketplace.
    
## Admin Page

1. **User-Specific Product List**: Upon logging in, each admin user has access to their own product list, where they can manage their product listings.

2. **Product Management**: Admin users can easily edit product information, add new products, and archive products to maintain an organized product catalog.

3. **Sold Page**: Admin users have a dedicated page to manage their sold products. They can update the shipping status, which automatically updates the availability and sold count of the specific products.

4. **Input Validation**: The application performs thorough validation to ensure that no empty values are allowed when adding or editing products.

5. **Checkbox Locking**: Once a product is marked as shipped, the checkbox is locked to prevent accidental changes.

6. **Archiving Products**: Instead of deletion, products can be archived for better organization and historical reference. The archive page shows all archived template, sellers can simplly edit them.


7. **Private Archiving**: Archived products are hidden from the public product list, providing a clutter-free and user-friendly experience for potential buyers.

8. **Multiple Rows for Purchases**: When multiple items are purchased in a single transaction, individual rows are displayed on the "Sold" page, maintaining a clear record of each sold item.



## Database Schema

![Database Schema](https://drive.google.com/file/d/1k6Ck5Lm6OiELjyU245184QfQR-awwaW5/view?usp=drive_link)

1. **Automatic Table Creation**: The application automatically creates necessary SQL tables (users, products, purchases) if they do not already exist.

2. **Fake Data for Testing**: For testing purposes, the database includes some pre-populated data, such as admin and test user accounts, as well as product listings.

   - Admin Username: admin, Password: admin
   - Test User Username: testuser, Password: testuser
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


