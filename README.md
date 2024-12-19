# Kuesioner Kepuasan Pasien

## 📄 Overview

This project is a patient satisfaction questionnaire system designed to collect and analyze patient feedback. It utilizes a fuzzyfication method to process survey responses and generate insightful results.

---

## 🛠️ Technologies Used

### Frontend:
- **JavaScript**
- **SCSS**
- **HTML5**

### Backend:
- **PHP Native**
- **XAMPP**

---

## 🔍 Fuzzyfication Method

The fuzzyfication method is implemented in the file:  
`/validations/proses_survey.php`

---

## 🚀 Running the Project Locally

Follow these steps to set up and run the project on your local machine:

### 1. Prerequisites
- Ensure you have **XAMPP** or any compatible local server installed.
- Start **Apache** and **MySQL** services via the XAMPP Control Panel.

### 2. Setting Up the Project
1. **Copy Files to `htdocs`:**
   - Place the project folder into the `htdocs` directory of your XAMPP installation.

2. **Create the Database:**
   - Open [phpMyAdmin](http://localhost/phpmyadmin/) in your browser.
   - Create a new database named `db_kuesioner`.

3. **Import the Database:**
   - Go to the `Import` tab in phpMyAdmin.
   - Select the SQL file located at `database/db_kuesioner.sql` in the project folder.
   - Click **Go** to import the database structure and data.

4. **Run the Project:**
   - Open your browser and navigate to:  
     [http://localhost/{project-folder-name}/index.php](http://localhost/{project-folder-name}/index.php)

---

## 🙏 Thanks

Thank you for using the **Kuesioner Kepuasan Pasien** system! Feel free to provide feedback or contribute to improving the project.
