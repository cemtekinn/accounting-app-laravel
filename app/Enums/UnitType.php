<?php

namespace App\Enums;

enum UnitType: string
{
    case piece = 'piece';
    case kilogram = 'kilogram';
    case gram = 'gram';
    case liter = 'liter';
    case milliliter = 'milliliter';
    case box = 'box';
    case meter = 'meter';
    case centimeter = 'centimeter';
    case millimeter = 'millimeter';
    case inch = 'inch';
    case square_meter = 'square_meter';
    case cubic_meter = 'cubic_meter';
    case cubic_centimeter = 'cubic_centimeter';
    case ton = 'ton';
    case gallon = 'gallon';
    case dozen = 'dozen';
    case package = 'package';


    public function getDescriptions(): string
    {
        return match ($this) {
            self::piece => 'Adet',
            self::kilogram => 'Kilogram',
            self::gram => 'Gram',
            self::liter => 'Litre',
            self::milliliter => 'Mililitre',
            self::box => 'Kutu',
            self::meter => 'Metre',
            self::centimeter => 'Santimetre',
            self::millimeter => 'Milimetre',
            self::inch => 'İnç',
            self::square_meter => 'Metrekare',
            self::cubic_meter => 'Metreküp',
            self::cubic_centimeter => 'Santimetreküp',
            self::ton => 'Ton',
            self::gallon => 'Galon',
            self::dozen => 'Düzine',
            self::package => 'Paket',
        };
    }

    public function getAbbreviations(): string
    {
        return match ($this) {
            self::piece => 'Ad.',
            self::kilogram => 'Kg',
            self::gram => 'g',
            self::liter => 'L',
            self::milliliter => 'mL',
            self::box => 'Kutu',
            self::meter => 'm',
            self::centimeter => 'cm',
            self::millimeter => 'mm',
            self::inch => 'in',
            self::square_meter => 'm²',
            self::cubic_meter => 'm³',
            self::cubic_centimeter => 'cm³',
            self::ton => 't',
            self::gallon => 'gal',
            self::dozen => 'Dz.',
            self::package => 'Paket',
        };
    }

    public function getDetailedDescriptions(): string
    {
        return match ($this) {
            self::piece => 'Adet: Birim sayısı',
            self::kilogram => 'Kilogram: 1000 gram',
            self::gram => 'Gram: Kütle birimi',
            self::liter => 'Litre: Hacim birimi',
            self::milliliter => 'Mililitre: Litre\'nin binde biri',
            self::box => 'Kutu: Paketleme birimi',
            self::meter => 'Metre: Uzunluk birimi',
            self::centimeter => 'Santimetre: Metrenin yüzde biri',
            self::millimeter => 'Milimetre: Metrenin binde biri',
            self::inch => 'İnç: 2.54 santimetre',
            self::square_meter => 'Metrekare: Alan birimi',
            self::cubic_meter => 'Metreküp: Hacim birimi',
            self::cubic_centimeter => 'Santimetreküp: Küçük hacim birimi',
            self::ton => 'Ton: 1000 kilogram',
            self::gallon => 'Galon: Hacim birimi',
            self::dozen => 'Düzine: 12 adet',
            self::package => 'Paket: Paketleme birimi',
        };
    }


}
