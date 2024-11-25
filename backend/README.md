# **READ ME**

## **Project Setup Guide**

---

### **First Step: Set Up Dolphin Authentication**

1. **Set Up Dolphin Database:**
   - Configure the Dolphin database settings in your `.env` file.

2. **Run Dolphin Binary:**
   - Once the database is configured, you can start Dolphin by either:
     - Opening a terminal and running the Dolphin binary, OR
     - Simply double-clicking the Dolphin executable file.

---

### **Second Step: Configure Laravel and Run Migration**

1. **Configure Laravel Environment:**
   - Update your Laravel `.env` file to ensure the correct configuration for the project (database, app key, etc.).

2. **Run Migration and Seed Database:**
   - You have two options to run the migration scripts:
     - **Option 1:** Run the development script:
       ```bash
       sh sh/dev.sh
       ```
     - **Option 2:** Run the update script:
       ```bash
       sh sh/update.sh
       ```

3. **Start Laravel Development Server:**
   - After the migrations, you can start the Laravel server by running:
     ```bash
     php artisan serve
     ```

---

### **Summary**
- Ensure that both Dolphin and Laravel environments are properly configured.
- Run the necessary migration scripts to set up the database.
- Finally, start the Laravel development server to begin working on the project.

---

### **Additional Notes:**
- If you encounter any errors related to the database or environment variables, double-check your `.env` configurations for both Dolphin and Laravel.
- Make sure your system has all the necessary dependencies installed (e.g., PHP, Composer, etc.).

---

Feel free to reach out if you have any questions regarding setup or deployment!
