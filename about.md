Good. Since you’re using Laravel, we’ll structure this properly so Cursor (or any AI assistant) clearly understands the system architecture and scope.

Below is a clean technical project description you can paste directly into Cursor.

---

# Project Description – Direct Housing Marketplace (Laravel)

## Overview

This project is a web-based housing marketplace that directly connects landlords and tenants without brokers. The platform allows landlords to list rental properties and tenants to search, view details, and communicate with landlords through an in-app chat system.

The initial phase (MVP) will focus only on essential features. Payment unlocking, number masking, and e-commerce modules will be added in future versions.

The system must be scalable and structured to allow future expansion without major refactoring.

---

## Tech Stack

* Backend: Laravel (latest version)
* Authentication: Phone-based OTP authentication
* Database: MySQL or PostgreSQL
* Maps: Google Maps API integration
* Frontend: Blade or Inertia (depending on structure)
* Role-based access control

---

## User Roles

There are three roles:

1. Admin
2. Landlord
3. Tenant

Use role-based middleware for access control.

---

## Authentication

* Phone number is the primary authentication field.
* OTP verification required during registration. - (Dont have API now so later)
* Both landlord and tenant must be authenticated.
* Role selection during registration (Landlord or Tenant).
* Admin created manually.

---

## Core Features (MVP)

### 1. Property Management (Landlord)

Landlords can:

* Create property listings
* Upload multiple images
* Set price
* Set minimum rental period (3 months, 6 months, etc.)
* Define property type:

  * Single room
  * Master bedroom
  * 1 bedroom
  * 2 bedroom
  * Full house
* Add:

  * Number of bedrooms
  * Number of living rooms
  * Number of toilets/bathrooms
  * Kitchen availability
  * Fence availability (boolean)
  * Parking availability
  * Property dimensions (room sizes)
* Add description
* Add Google Maps location (latitude & longitude)
* Indicate distance from main road (manual input for MVP)

Landlord dashboard:

* View own listings
* Edit listings
* Delete listings
* View incoming chats

---

### 2. Property Browsing (Tenant)

Tenants can:

* Search properties
* Filter by:

  * Price range
  * Location
  * Property type
  * Minimum rental period
* View full property details
* View images
* View map location
* Start chat with landlord

Tenant dashboard:

* View saved properties (optional MVP)
* View active chats

---

### 3. In-App Chat (Basic Version)

* One-to-one chat between landlord and tenant
* Real-time or AJAX polling
* Notifications when new message arrives
* Messages stored in database
* No number masking yet (future feature)
* No pay-to-unlock yet (future feature)

---

### 4. Admin Dashboard

Admin can:

* View total users
* View landlords and tenants separately
* View total listings
* Approve, edit, or delete listings
* Manually assign “Verified” badge to property
* Monitor system activity

---

## Database Structure (High-Level)

Tables:

* users

  * id
  * name
  * phone
  * role (admin, landlord, tenant)
  * is_verified_phone
  * timestamps

* properties

  * id
  * landlord_id
  * title
  * price
  * minimum_rent_months
  * property_type
  * bedrooms
  * living_rooms
  * bathrooms
  * kitchens
  * has_fence
  * has_parking
  * dimensions
  * description
  * latitude
  * longitude
  * distance_from_main_road
  * is_verified
  * timestamps

* property_images

  * id
  * property_id
  * image_path

* chats

  * id
  * property_id
  * landlord_id
  * tenant_id

* messages

  * id
  * chat_id
  * sender_id
  * message
  * is_read
  * timestamps

---

## Future Expansion (Do Not Implement Now)

System must be structured to later support:

* Pay-to-unlock contact system
* Mobile money integration (Selcom / PesaPal)
* Number masking inside chat
* Property review system
* Furniture e-commerce module
* Premium listings
* Featured placements

Database and architecture must allow these additions without major structural changes.

---

## Important Architectural Notes
* Use Laravel Policies for property ownership control.
* Use Events & Notifications for chat notifications.
* Use Laravel Queues for scalable notification handling.
* Keep controllers thin, use Service classes where necessary.
* Design system API-ready for future mobile app.

---

If you want, next I can:

* Generate Laravel migration files
* Suggest project folder structure
* Outline API routes
* Help you structure MVP development roadmap in phases

Tell me how you want to proceed.
