<?php

declare(strict_types=1);

namespace SavvyWombat\Color;

class Hex extends Color
{
    protected $hexRed;
    protected $hexGreen;
    protected $hexBlue;
    protected $hexAlpha;

    protected static $namedColors = [
        // CSS Level 1
        'black' => '#000000',
        'silver' => '#c0c0c0',
        'gray' => '#808080',
        'white' => '#ffffff',
        'maroon' => '#800000',
        'red' => '#ff0000',
        'purple' => '#800080',
        'fuchsia' => '#ff00ff',
        'green' => '#008000',
        'lime' => '#00ff00',
        'olive' => '#808000',
        'yellow' => '#ffff00',
        'navy' => '#000080',
        'blue' => '#0000ff',
        'teal' => '#008080',
        'aqua' => '#00ffff',

        // CSS Level 2
        'orange' => '#ffa500',

        // CSS Color Module Level 3
        'aliceblue' => '#f0f8ff',
        'antiquewhite' => '#faebd7',
        'aquamarine' => '#7fffd4',
        'azure' => '#f0ffff',
        'beige' => '#f5f5dc',
        'bisque' => '#ffe4c4',
        'blanchedalmond' => '#ffebcd',
        'blueviolet' => '#8a2be2',
        'brown' => '#a52a2a',
        'burlywood' => '#deb887',
        'cadetblue' => '#5f9ea0',
        'chartreuse' => '#7fff00',
        'chocolate' => '#d2691e',
        'coral' => '#ff7f50',
        'cornflowerblue' => '#6495ed',
        'cornsilk' => '#fff8dc',
        'crimson' => '#dc143c',
        'cyan' => '#00ffff',
        'darkblue' => '#00008b',
        'darkcyan' => '#008b8b',
        'darkgoldenrod' => '#b8860b',
        'darkgray' => '#a9a9a9',
        'darkgreen' => '#006400',
        'darkgrey' => '#a9a9a9',
        'darkkhaki' => '#bdb76b',
        'darkmagenta' => '#8b008b',
        'darkolivegreen' => '#556b2f',
        'darkorange' => '#ff8c00',
        'darkorchid' => '#9932cc',
        'darkred' => '#8b0000',
        'darksalmon' => '#e9967a',
        'darkseagreen' => '#8fbc8f',
        'darkslateblue' => '#483d8b',
        'darkslategray' => '#2f4f4f',
        'darkslategrey' => '#2f4f4f',
        'darkturquoise' => '#00ced1',
        'darkviolet' => '#9400d3',
        'deeppink' => '#ff1493',
        'deepskyblue' => '#00bfff',
        'dimgray' => '#696969',
        'dimgrey' => '#696969',
        'dodgerblue' => '#1e90ff',
        'firebrick' => '#b22222',
        'floralwhite' => '#fffaf0',
        'forestgreen' => '#228b22',
        'gainsboro' => '#dcdcdc',
        'ghostwhite' => '#f8f8ff',
        'gold' => '#ffd700',
        'goldenrod' => '#daa520',
        'greenyellow' => '#adff2f',
        'grey' => '#808080',
        'honeydew' => '#f0fff0',
        'hotpink' => '#ff69b4',
        'indianred' => '#cd5c5c',
        'indigo' => '#4b0082',
        'ivory' => '#fffff0',
        'khaki' => '#f0e68c',
        'lavender' => '#e6e6fa',
        'lavenderblush' => '#fff0f5',
        'lawngreen' => '#7cfc00',
        'lemonchiffon' => '#fffacd',
        'lightblue' => '#add8e6',
        'lightcoral' => '#f08080',
        'lightcyan' => '#e0ffff',
        'lightgoldenrodyellow' => '#fafad2',
        'lightgray' => '#d3d3d3',
        'lightgreen' => '#90ee90',
        'lightgrey' => '#d3d3d3',
        'lightpink' => '#ffb6c1',
        'lightsalmon' => '#ffa07a',
        'lightseagreen' => '#20b2aa',
        'lightskyblue' => '#87cefa',
        'lightslategray' => '#778899',
        'lightslategrey' => '#778899',
        'lightsteelblue' => '#b0c4de',
        'lightyellow' => '#ffffe0',
        'limegreen' => '#32cd32',
        'linen' => '#faf0e6',
        'magenta' => '#ff00ff',
        'mediumaquamarine' => '#66cdaa',
        'mediumblue' => '#0000cd',
        'mediumorchid' => '#ba55d3',
        'mediumpurple' => '#9370db',
        'mediumseagreen' => '#3cb371',
        'mediumslateblue' => '#7b68ee',
        'mediumspringgreen' => '#00fa9a',
        'mediumturquoise' => '#48d1cc',
        'mediumvioletred' => '#c71585',
        'midnightblue' => '#191970',
        'mintcream' => '#f5fffa',
        'mistyrose' => '#ffe4e1',
        'moccasin' => '#ffe4b5',
        'navajowhite' => '#ffdead',
        'oldlace' => '#fdf5e6',
        'olivedrab' => '#6b8e23',
        'orangered' => '#ff4500',
        'orchid' => '#da70d6',
        'palegoldenrod' => '#eee8aa',
        'palegreen' => '#98fb98',
        'paleturquoise' => '#afeeee',
        'palevioletred' => '#db7093',
        'papayawhip' => '#ffefd5',
        'peachpuff' => '#ffdab9',
        'peru' => '#cd853f',
        'pink' => '#ffc0cb',
        'plum' => '#dda0dd',
        'powderblue' => '#b0e0e6',
        'rosybrown' => '#bc8f8f',
        'royalblue' => '#4169e1',
        'saddlebrown' => '#8b4513',
        'salmon' => '#fa8072',
        'sandybrown' => '#f4a460',
        'seagreen' => '#2e8b57',
        'seashell' => '#fff5ee',
        'sienna' => '#a0522d',
        'skyblue' => '#87ceeb',
        'slateblue' => '#6a5acd',
        'slategray' => '#708090',
        'slategrey' => '#708090',
        'snow' => '#fffafa',
        'springgreen' => '#00ff7f',
        'steelblue' => '#4682b4',
        'tan' => '#d2b48c',
        'thistle' => '#d8bfd8',
        'tomato' => '#ff6347',
        'turquoise' => '#40e0d0',
        'violet' => '#ee82ee',
        'wheat' => '#f5deb3',
        'whitesmoke' => '#f5f5f5',
        'yellowgreen' => '#9acd32',

        // CSS Color Level 4
        'rebeccapurple' => '#663399',
    ];

    public function __construct(string $red, string $green, string $blue, string $alpha = 'ff')
    {
        if (1 === mb_strlen($red)) {
            $red .= $red;
        }
        if (1 === mb_strlen($green)) {
            $green .= $green;
        }
        if (1 === mb_strlen($blue)) {
            $blue .= $blue;
        }
        if (1 === mb_strlen($alpha)) {
            $alpha .= $alpha;
        }

        $this->hexRed = mb_strtolower(self::validateChannel('red', $red));
        $this->hexGreen = mb_strtolower(self::validateChannel('green', $green));
        $this->hexBlue = mb_strtolower(self::validateChannel('blue', $blue));
        $this->hexAlpha = mb_strtolower(self::validateChannel('alpha', $alpha));

        $this->red = hexdec($red);
        $this->green = hexdec($green);
        $this->blue = hexdec($blue);
        $this->alpha = hexdec($alpha) / 255;
    }

    public static function validateChannel($channel, $value)
    {
        if ( ! preg_match("/^[0-9a-f]{2}$/i", $value)) {
            throw Exception::invalidChannel($channel, $value, 'must be a valid hex value (0-f or 00-ff)');
        }

        return $value;
    }

    public static function fromString(string $colorSpec): ColorInterface
    {
        if (isset(self::$namedColors[$colorSpec])) {
            $colorSpec = self::$namedColors[$colorSpec];
        }

        $channels = Color::extractChannels($colorSpec, self::class);

        if (empty($channels)) {
            throw Exception::invalidHexSpec($colorSpec);
        }

        if ( ! isset($channels[4])) {
            $channels[4] = 'ff';
        }

        return new Hex($channels[1], $channels[2], $channels[3], $channels[4]);
    }

    public static function fromRgb(Rgb $rgb): ColorInterface
    {
        return new Hex(
            str_pad(dechex((int) round($rgb->red)), 2, '0', \STR_PAD_LEFT),
            str_pad(dechex((int) round($rgb->green)), 2, '0', \STR_PAD_LEFT),
            str_pad(dechex((int) round($rgb->blue)), 2, '0', \STR_PAD_LEFT),
            str_pad(dechex((int) round($rgb->alpha * 255)), 2, '0', \STR_PAD_LEFT)
        );
    }

    public static function namedColors(): array
    {
        return self::$namedColors;
    }

    public function __toString(): string
    {
        if ('ff' === $this->hexAlpha) {
            return "#{$this->hexRed}{$this->hexGreen}{$this->hexBlue}";
        }

        return "#{$this->hexRed}{$this->hexGreen}{$this->hexBlue}{$this->hexAlpha}";
    }
}
