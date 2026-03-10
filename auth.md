Perfect. Let’s structure this carefully so your wizard-based authentication works properly, role management is clean, and the system is ready for Tanzania context (phone-first login). I’ll break it down as implementation steps that your developer (Cursor) can follow step by step, without giving actual code.

High-Level Plan for MakaziDirect Auth System
1️⃣ Define Roles & Seeder

Roles: admin, tenant, landlord

Admin registration: via seeder only, assign admin role

Tenant & Landlord: wizard registration, not direct creation

Implementation Note: Ensure all users are connected with roles in the system (Spatie Roles package).

2️⃣ Wizard Registration Flow

Step 1: Role Selection

On register page, user selects Tenant or Landlord

Save this selection temporarily in session or frontend state

Step 2: Tenant Registration

Fields: name, email, phone number, password

Validate phone number format (Tanzania, e.g., +2557xxxxxxx)

Save user as tenant role, mark as active immediately

Optionally, redirect to tenant dashboard

Step 3: Landlord Registration

Fields: name, email, phone number, password

Additional fields: NIDA, screenshot of electricity or water bill

Validate all documents and phone number

Save user as landlord role but status = pending approval

Admin will review documents before activating the account

Step 4: Phone as Primary Login

Login page allows phone number or email (prefer phone)

Authenticate using Sanctum token (for API)

Validate role-based access to dashboards

3️⃣ Multi-Step Wizard Implementation

Each step should save temporary data (session or local storage) until final submission

Provide back & next buttons for smooth UX

Show progress indicator (Step 1: Role → Step 2: Personal Info → Step 3: Extra Docs if landlord)

For Landlord: Final step is document upload + submit for approval
For Tenant: Final step is simple personal info + submit

4️⃣ Admin Approval for Landlords

Admin dashboard shows pending landlord applications

Admin can approve or reject

On approval: set status to active, send confirmation email or SMS

Optionally, auto-generate temporary password if not set

5️⃣ Authentication Logic

Sanctum-based token authentication (for API or SPA)

Role-based redirects after login:

Tenant → Tenant dashboard

Landlord → Landlord dashboard (if approved)

Admin → Admin dashboard

Login via phone (primary) or email

6️⃣ Validation & Security

Phone number required, unique

Email optional but recommended

Documents encrypted and stored securely

Passwords hashed

Prevent unapproved landlords from logging in

7️⃣ Optional Enhancements

Progress-saving for landlords if they abandon wizard halfway

Notifications for tenants/landlords on approval, rejection, or messages

Multi-step form should be mobile-friendly (important for Tanzanian users)

Keep registration wizard logic separated by role for clean code

Step-By-Step Cursor Should Follow

Seed roles and admin user

Create wizard registration frontend → role selection step

Implement tenant registration flow → store as active tenant

Implement landlord registration flow → store as pending landlord

Implement document upload & validation

Implement admin approval panel

Implement Sanctum authentication → login by phone/email

Implement role-based dashboard redirects

Test full registration, approval, and login flows

Enhance UX (progress bar, mobile friendly, error handling)