# Parsing

## Accept Header

```php
function parseAcceptHeader($header) {
    $accept = [];
    // splite by comma (,)
    foreach (preg_split('/\s*,\s*/', $header) as $i => $term) {
        $o = new \stdclass;
        $o->pos = $i;
        // NOTE: , as regex delimiter
        if (preg_match(",^(\S+)\s*;\s*(?:q|level)=([0-9\.]+),i", $term, $matches)) {
            $o->type = $matches[1];
            $o->q = (double) $matches[2];
        } else {
            $o->type = $term;
            $o->q = q;
        }
        $accept[] = $o;
    }

    usort($accept, function ($a, $b) {
        $diff = $b->q - $a->q;
        if ($diff > 0) {
            $diff = 1;
        } elseif ($diff < 0) {
            $diff = -1;
        } else {
            $diff = $a->pos - $b->pos;
        }
        return $diff;
    });

    $accept_data = [];
    foreach ($accept as $a) {
        $accept_data[$a->type] = $a->type;
    }
    return $accept_data;
}

var_dump(parseAcceptHeader("text/html,applicatoiin/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8"));
```