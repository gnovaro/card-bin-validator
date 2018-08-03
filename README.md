# card-bin-validator
PHP Card BIN code validaton API.

Credit and Debit Card validation.

BIN: 6 first digits of the card.

## Usage
index.php?bin=377790

## Response

### Success
```json
{
  "BANK":"SANTANDER_RIO",
  "CARD_TYPE":"CREDIT",
  "BRAND":"AMEX",
  "CVV_LONG":4,
  "CHAR_LONG":15
}
```
