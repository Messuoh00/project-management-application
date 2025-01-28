# Project Management Application

This repository contains the source code for a web-based project management application designed to streamline the management of research and development (R&D) projects. The application automates workflows, centralizes project data, and facilitates collaboration within teams.

![image](https://github.com/user-attachments/assets/1d3c60d2-d900-4a1a-ba80-aea937b4fb23)
## Features

- **User Authentication:** Secure login system with roles for administrators, employees, division managers, and vice presidents.
- **Project Management:** Create, modify, and archive projects. Track phases, budgets, and team progress.
- **Role-Based Access Control:** Assign roles and permissions to ensure users can access appropriate features and data.
- **Collaboration Tools:** Share files, publications, and knowledge between employees and teams.
- **Statistical Analysis:** Visualize project data and team performance through charts and statistics.
- **Responsive Design:** Accessible on all devices and screen sizes.

## Technologies Used

- **Backend:** PHP (Laravel Framework)
- **Frontend:** HTML, CSS (Bootstrap), JavaScript (jQuery, Chart.js)
- **Database:** MySQL
- **Development Tools:** XAMPP, Visual Studio Code, GitHub

## Getting Started

### Prerequisites

- PHP >= 7.4
- MySQL >= 5.7
- Composer
- Node.js and npm (for frontend dependencies)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Messuoh00/project-management-application.git
   cd project-management-application
   ```

2. Install backend dependencies:
   ```bash
   composer install
   ```

3. Install frontend dependencies:
   ```bash
   npm install
   ```

4. Set up the `.env` file:
   - Copy the `.env.example` to `.env`.
   - Update database credentials and other configurations.

5. Run migrations:
   ```bash
   php artisan migrate
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

### Usage

- Visit `http://localhost:8000` in your web browser.
- Use default admin credentials (if provided) to log in and start managing projects.

## Documentation

The complete documentation, including the application's purpose, architecture, and UML diagrams, is available in the attached PDF file (`pfe.pdf`). It describes the conceptual and technical details of the project in French.

## Screenshots


![image](https://github.com/user-attachments/assets/a073b1b4-3ab1-493a-b808-03bf0bc20ba8)
![image](https://github.com/user-attachments/assets/35e1f8a8-c392-4d1f-9dba-f32551d0b0ad)
![image](https://github.com/user-attachments/assets/c7aded2b-fb3f-4a9a-9ca9-773b9bb936a3)
![image](https://github.com/user-attachments/assets/7f3c029a-bb45-4816-a32d-0633e484126a)

