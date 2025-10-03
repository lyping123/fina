const puppeteer = require("puppeteer");

(async () => {
  const browser = await puppeteer.launch({
    headless: false, // run with UI to look like real browser
    args: [
      "--no-sandbox",
      "--disable-setuid-sandbox",
      "--disable-blink-features=AutomationControlled"
    ]
  });

  const page = await browser.newPage();

  // Pretend to be a normal browser
  await page.setUserAgent(
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 " +
    "(KHTML, like Gecko) Chrome/118.0.5993.88 Safari/537.36"
  );

  await page.goto("https://registration.synergycollege2u.com/f_print_receipt.php?id=16876", {
    waitUntil: "networkidle2",
    timeout: 0
  });

  await page.waitForSelector("#content", { timeout: 60000 });

  await page.pdf({
    path: "receipt.pdf",
    format: "A4",
    printBackground: true
  });

  await browser.close();
})();
