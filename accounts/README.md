Installation Notes:

1. Copy full folder to your www/public_html folder
2. Create a database with user access
3. Point to www.yourdomain.com/install
4. Give your database hostname, database Username, password and database name
5. Choose your desire username (should be your email address) and password for application login
6. Click Install and you will redirect to your login page.


Change Log

Version – 2.1.0 – 8th January, 2018
    Add: New User Experience
    Fixed: Preview and Print Invoice
    Fixed: Retport view
    Fixed: Sales return bug

Version – 2.0.3 – 18th December, 2018
    Fixed: Inventory report is not working.
    Fixed: Sales return report is not working.

Version – 2.0.2 – 16th December, 2018
    Fixed: Purchase return is not working.
    Fixed: Purchase return quantity can return more than purchase quantity.
    Fixed: Purchase report is not working.
    Fixed: Sales return quantity can't resell.
    Fixed: Sales return can receive more than sold quantity.

Version – 2.0.1 – 22th November, 2018
    Fixed: Sales return entry date not entered properly.
    Fixed: Sales tax not included in sales invoice preview and print section.
    Add: Unsaved sales entry remove when leaving the page without complete sales.
    Add: Unsaved sales return entry remove when leaving the page without complete sales return.
    Add: Unsaved purchase entry remove when leaving the page without complete purchase.
    Add: Unsaved purchase return entry remove when leaving the page without complete purchase return.
    Add: Unsaved journal entry remove when leaving the page without complete journal.
    Add: Show current version in application login, forgot password, password reset and admin dashboard.

Version – 2.0.0 – 18th November, 2018

    Update: CodeIgniter core updated to 3.1.9
    Update: UI to AdminLTE 2.4.5
    Add: Sales Tax.
    Add: Proper code comment.

Version – 1.2.6 – 30th June, 2016

    Fixed: Major bug fix on income statement.
    Add: Add AVCO method for COGS.
    Add: Company wise currency management.
    Add: Password reset facility.

Version – 1.2.5 – 7th May, 2016

    Fixed: User edit update the user company to logged in user's company.
    Fixed: Can't change user type.
    Fixed: Normal user should not get "Change Permission" button.
    Add: Company column in user list.

Version – 1.2.4 – 19th April, 2016

    Update: CodeIgniter core updated to 3.0.6
    Update: Dashboard widget security.
    Update: Create new user redirect to user permission page.
    Fixed: Power User can't get Admin user amd User can't get Power User.
    Fixed: Add multiple debit or credit entry in journal through javascript error.

Version – 1.2.3 – 17th March, 2016

    Update: CodeIgniter core updated to 3.0.5
    Fixed: Installation script fix the base url.

Version – 1.2.2 – 16th November, 2015

    Fixed: Ajax call prevented, such as add item, delete item on sales and purchase.

Version – 1.2.1 – 13th November, 2015

    Fixed: Update Installer.
    Fixed: Non-existent class: Session.
    Fixed: Model file name.
    Fixed: Profile info edit through error.
    Add: CodeIgniter core update to 3.0.3

Version – 1.2.0 – 17th October, 2015

    Fixed: Accept duplicate item code.
    Fixed: Item status not working as expected.
    Add: Item add form re-populate on error.
    Add: CodeIgniter core update to 3.0.1

Version – 1.1.5 – 22th August, 2015

    Fixed: New company default/power user not activated.
    Fixed: New company didn't add default A/C head.
    Fixed: Add cost of goods sold option for default A/C head.
    Fixed: User edit selected wrong company.

Version – 1.1.4 – 25th July, 2015

    Fixed: Employee delete shows 404
    Add: Sales Return Management.
    Add: Purchase Return Management.
    Add: Sales Return Report.
    Add: Purchase Return Report.
    Add: Inventory Report update with Sales Return and Purchase Return.

Version – 1.1.3 – 19th June, 2015

    Fixed: .htaccess fix for CodeIgniter 2.2.2
    Fixed: PDF library changed from dompdf to mdpf for better support.
    Add: PDF export option for Inventory Report.

Version – 1.1.2 – 18th June, 2015

    Fixed: Error in inventory report with same item name.
    Add: Upgrade CodeIgniter core to 2.2.2 from 2.2.1
    Add: PDF export option for Purchase Report.
    Add: PDF export option for Sales Report.

Version – 1.1.1 – 6th June, 2015

    Fixed: Breaks Sidebar on Add New Employee.
    Add: Create customer in sales page without leaving the page.
    Add: Create supplier in purchase page without leaving the page.

Version – 1.1.0 – 25th May, 2015

    Fixed: Sales edit create duplicate journal.
    Fixed: Purchase edit create duplicate journal.
    Fixed: Money Receipt edit create duplicate journal.
    Fixed: Payment Receipt edit create duplicate journal.
    Fixed: Delete sales not deleted journal.
    Fixed: Delete purchase not deleted journal.
    Fixed: Delete Money Receipt not deleted journal.
    Fixed: Delete Payment Receipt not deleted journal.
    Fixed: Delete partial or full cash sales not delete auto money receipt.
    Fixed: Delete partial or full cash purchase not delete auto payment receipt.
    Fixed: Remove opening balance from A/C head, not it need a journal to entry.
    Fixed: User permission.
    Add: Cash/Cheque option for money receipt.
    Add: Cash/Cheque option for payment receipt.
    Add: Notes field in customer entry.
    Add: Notes field in supplier entry.
    Add: Item code in sales entry item dropdown and item list details table.
    Add: Item code in purchase entry item dropdown and item list details table.
    Add: Customer Code manually entry/edit.
    Add: Supplier code manually entry/edit.

Version – 1.0.6 – 13th May, 2015

    Fixed: Opening credit balance (-) shows debit (+) in ledger.
    Fixed: Dropdown search not worked as expected.


Version – 1.0.5 – 7th May, 2015

    Fixed: Payment Receipt shows Money Receipt in report.
    Fixed: Money Receipt wrong journal entry.
    Fixed: Full credit purchase hits cash in journal.
    Fixed: Full credit sales hits cash in journal.
    Fixed: User entry with existing email address.


Version – 1.0.4 – 5th May, 2015

    Fixed: Wrong date show in all accounts report.


Version – 1.0.3 – 20th April, 2015

    Fixed: Item can not sell more that stock balance.


Version – 1.0.2 – 17th April, 2015

    Fixed: View Ledger Report without select A/C head through error.
    Fixed: In Ledger Report details, click on ledger number through 404 error.
    Added: Money Receipt preview option.
    Added: Payment Receipt preview option.


Version – 1.0.1 – 16th April, 2015

    Added: Sales form validation before ajax submit.
    Added: Purchase form validation before ajax submit.


Version – 1.0.0 – 15th April, 2015

    Initial Release.