# card-bin-validator
PHP Card BIN / IIN code Validaton API.

Credit and Debit Card validation.

BIN: 6 first digits of the card.

## Usage
index.php?bin=377790

## Response
HTTP Status + JSON

### Success
```json
{
  "BANK":"SANTANDER RIO",
  "CARD_TYPE":"CREDIT",
  "BRAND":"AMEX",
  "CVV_LONG":4,
  "CHAR_LONG":15,
  "COUNTRY":"AR"
}
```
