# INTEGRATED CRM/ERP WEB

**Created by:** Hexosaur 

### Key Sections:

- **Overview**: Briefly introduces the project and its current features.
- **Current Development Status**: Highlights ongoing and completed features like employee management and leave management.
- **Future Features**: Lists the features planned for future releases.
- **Technologies Used**: Describes the tech stack used for the development.
- **Setup Instructions**: Provides detailed steps to set up the project locally.
- **License**: Mentions the open-source license and credits.

This `README.md` serves as a reference for setting up the system, while also detailing the ongoing development and planned features.



## Overview

This project is a **continuous development** of an Employee and Leave Management System built to simplify and streamline employee data management, roles, and leave requests. The system is designed to help companies efficiently track employee details, roles, and their leave requests while ensuring an easy and flexible user experience.

### Current Development Status

As of the moment, the following features are **actively being developed** or **are already implemented**:

- **Employee Management**: Allows the addition, modification, and deletion of employee records, which include personal details, department information, assigned roles, and employment status.
- **Leave Management**: Enables employees to request leave, which then goes through a hierarchical approval process. The leave system is still in development.

### Future Features (Planned)

The system is constantly evolving and will soon include:
- **Branch Management**: To track multiple company branches and assign employees accordingly.
- **Role Permissions**: Defining access levels for different roles within the company (Admin, Manager, Employee).
- **Full Reports and Dashboards**: Providing detailed insights and analytics on employee attendance, leave status, and performance.
- **User Authentication**: To enable secure login and tracking of employee activities.
- **Evaluation System**: For performance reviews and feedback from supervisors.
- **Access Control**: Role-based permissions and hierarchical access control for managers and employees.

## Technologies Used

- **Backend**: PHP, MySQL
- **Frontend**: HTML, CSS, Bootstrap, JavaScript, jQuery
- **Database**: MySQL (Relational Database)
- **Version Control**: Git (GitHub)

## Features

1. **Employee Registration**: Adds new employees and assigns them to specific departments and roles. 
2. **Employee Role and Permission Management**: Assign roles and manage permissions for employees.
3. **Leave Request**: Allows employees to submit leave requests, which are approved by their department head, branch manager, and HR.
4. **Department and Role Management**: Static departments (e.g., HR, IT, Sales) with corresponding employee roles.
5. **Customizable Branches**: Employees can be assigned to different branches within the organization.
6. **Real-time Notifications**: Sends notifications on successful updates or errors for better user experience.



# GUIDELINE SAMPLE ON FOR PRE SETUPS
| **Access Level** | **Role Name**           | **Use Case**                                                          |
|------------------|-------------------------|-----------------------------------------------------------------------|
| 150              | Admin                   | Full system access; can approve anything                              |
| 130              | Regional Manager        | Can oversee multiple branches and locations                           |
| 120              | HR Admin                | Full HR access, including data management                             |
| 110              | Branch Manager          | Full access within their branch                                       |
| 100              | Manager                 | Can approve leave within the department                               |
| 70               | Department Head         | Manages entire department                                             |
| 60               | Leave Coordinator       | Manages leave requests, not other HR tasks                            |
| 50               | Supervisor              | Can approve leave requests for their team                             |
| 30               | Team Leader             | Manages a small team or group of employees                            |
| 5                | Employee                | Can only request their own leave                                      |
| 1                | Team Member (Trainee)   | Limited access, might not be able to request leave or only have partial access |








## Setup Instructions

1. **Clone the Repository**
   ```bash
   gh repo clone hexosaur/mywiz-reform
