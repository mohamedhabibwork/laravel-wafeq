---
updatedAt: 2025-09-11T23:41:03.000Z
---

Fetch the complete documentation index at: https://developer.wafeq.com/llms.txt. Use this file to discover all available pages before exploring further. Append .md to any documentation page URL to get its markdown version.

# Calculations and Rounding

While calculating tax total and the subtotal on an invoice, each individual line amount is rounded to 2 decimal places then summed to get the tax total.\
The method used to round is to round half up.

| Name              | Amount | Tax Rate | Tax (before rounding) | Tax (after rounding) | Totals |
| :---------------- | -----: | -------: | --------------------: | -------------------: | -----: |
| Line item 1       |  45.30 |       5% |                 2.265 |                 2.27 |        |
| Line item 2       |  33.45 |      10% |                 3.345 |                 3.35 |        |
| Total Tax Amounts |        |          |                       |                 5.62 |        |
| **Total**         |  78.75 |          |                       |                      |  84.37 |