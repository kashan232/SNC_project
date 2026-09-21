const fs = require('fs');
let f = 'resources/views/frontend/pages/product_detail.blade.php';
let c = fs.readFileSync(f, 'utf8');

c = c.replace(/\\n/g, '\n');
c = c.replace(/\\'/g, "'");

fs.writeFileSync(f, c);
