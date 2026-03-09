import { chromium } from 'playwright';

(async () => {
    const browser = await chromium.launch({ headless: true });
    const context = await browser.newContext({
        viewport: { width: 1280, height: 800 },
        colorScheme: 'dark' // Assuming the user might want a good looking UI. We'll capture default.
    });
    const page = await context.newPage();

    console.log('Navigating to login...');
    await page.goto('http://localhost:8000/login');

    await page.fill('input[name="email"]', 'admin@example.com');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    console.log('Waiting for dashboard...');
    await page.waitForURL('**/dashboard**', { timeout: 10000 }).catch(e => console.log('Timeout waiting for dashboard'));
    await page.waitForTimeout(2000); // Wait for images / feed to load
    await page.screenshot({ path: 'Alumni_System_FSD_Report/dashboard_page.png', fullPage: false });
    console.log('Dashboard captured.');

    console.log('Navigating to messages...');
    await page.goto('http://localhost:8000/messages');
    await page.waitForTimeout(2000); // Wait for chat to load
    await page.screenshot({ path: 'Alumni_System_FSD_Report/messages_page.png', fullPage: false });
    console.log('Messages captured.');

    console.log('Navigating to Alumni directory...');
    await page.goto('http://localhost:8000/alumni');
    await page.waitForTimeout(2000);
    await page.screenshot({ path: 'Alumni_System_FSD_Report/directory_page.png', fullPage: false });
    console.log('Directory captured.');

    await browser.close();
})();
