# Country-to-Locale
Determine locale from 2-letter country code. (Can be used as language code.)

## Usage

```php
use peterkahl\locale\locale;

echo locale::country2locale('DE'); # 'de_DE'

echo locale::country2locale('CN'); # 'zh_CN'
```
