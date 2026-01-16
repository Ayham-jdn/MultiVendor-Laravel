# Multi-Vendor Laravel Project (Learning Experience)

This project is a **Multi-Vendor e-commerce website** built using **Laravel**.  
It was a personal learning experience before I started studying **.NET C#**, and it helped me understand many **backend concepts and challenges**.

---

## Key Features Implemented

- Multi-vendor support: Every seller can open multiple stores
- Vendor dashboard & Admin dashboard
- “Become a Seller” request to admin
- Profile photo upload & edit profile page
- Add to cart **without login**
- Order tracking
- Create coupon codes & discount options
- Product, brand, and category management
- Product likes, comments, and ratings
- Admin can manage sellers and stores
- Notifications system
- Pagination for product listings
- Middleware for route protection
- Affiliate system

---

## Project Notes

- This was a **learning project**; the goal was to implement a large multi-vendor system from scratch.
- I **did not use any frontend framework**; all pages are plain Blade + Bootstrap.
- The project grew very large with **many routes and over 25 controllers**, making it a challenge to manage.
- It was an **incredible learning experience**, teaching me:
  - Backend fundamentals
  - Working with MVC and Blade templates
  - Managing complex CRUD operations
  - Handling roles, permissions, and middleware
- I want to **share this experience** even though the project is too big for a production-ready site.

---

## Installation (if you want to test locally)

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed` (if applicable)
6. Serve: `php artisan serve`

---

## Note

This repository is **for educational purposes** only.  
It demonstrates my learning journey in backend web development and experience building complex Laravel applications.
