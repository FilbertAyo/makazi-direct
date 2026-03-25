Here’s a clean, execution-ready description you can hand over:

---

**Makazi Direct – Required System Improvements (MVP Enhancement Scope)**

Makazi Direct is a property rental platform connecting tenants, landlords, and administrators. The current MVP is functional, but several usability and feature gaps need to be addressed to improve user experience and platform effectiveness.

### 1. Administrator Dashboard UI Enhancement 

The administrator dashboard currently uses the default Laravel interface, which is not user-friendly or visually aligned with modern UI standards.
The requirement is to redesign and restructure the admin dashboard to fully match a provided UI template. The implementation should strictly follow the layout, components, and styling of the selected template to ensure consistency, usability, and a professional look and feel.

template = /template

### 2. Landlord Feature Enhancements

**a. Contact Information Management**
Landlords should have the ability to manage and display their contact details within their property listings.

* They must be able to add and update multiple phone numbers and optionally other contact details.
* These contact details should be linked to each property they create.

**b. Property Rules and Policies**
When creating or updating a property, landlords must be able to define house rules or policies.

* A dedicated section should be added where landlords can describe rules (e.g., no pets, no noise after certain hours, payment terms, etc.).
* These rules should be clearly visible to tenants when viewing property details.

### 3. Tenant Access Control and Interaction

**a. Restricted Contact Visibility**
Tenants browsing properties should not immediately see full landlord contact details.

* Contact information (e.g., phone numbers) should be partially hidden or masked by default.
* To view full contact details, the tenant must be authenticated (registered and logged in).

**b. Authentication Requirement for Communication**

* Tenants must be required to register/login before accessing full property details, including contact information.
* Only authenticated users should be able to initiate or continue chats with landlords.

**c. Property Details Visibility**

* Once authenticated, tenants should be able to view full landlord contact details and property rules.
* The experience should feel seamless, encouraging users to sign up in order to unlock full access.

---

**Summary**
These improvements focus on three key areas:

1. Upgrading the admin interface to a modern, template-based UI.
2. Giving landlords more control over property information, especially contacts and house rules.
3. Enforcing authentication for tenants before accessing sensitive details and enabling communication.

The goal is to improve usability, trust, and engagement while maintaining a clean and scalable system structure.

---

If you want, next step I can break this into actual implementation tasks (backend + frontend) so your developer (or you) can execute faster.
