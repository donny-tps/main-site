<?php
 namespace FontLib\Table\Type; use FontLib\Table\Table; class loca extends Table { protected function _parse() { $font = $this->getFont(); $offset = $font->pos(); $indexToLocFormat = $font->getData("head", "indexToLocFormat"); $numGlyphs = $font->getData("maxp", "numGlyphs"); $font->seek($offset); $data = array(); if ($indexToLocFormat == 0) { $d = $font->read(($numGlyphs + 1) * 2); $loc = unpack("n*", $d); for ($i = 0; $i <= $numGlyphs; $i++) { $data[] = $loc[$i + 1] * 2; } } else { if ($indexToLocFormat == 1) { $d = $font->read(($numGlyphs + 1) * 4); $loc = unpack("N*", $d); for ($i = 0; $i <= $numGlyphs; $i++) { $data[] = $loc[$i + 1]; } } } $this->data = $data; } function _encode() { $font = $this->getFont(); $data = $this->data; $indexToLocFormat = $font->getData("head", "indexToLocFormat"); $numGlyphs = $font->getData("maxp", "numGlyphs"); $length = 0; if ($indexToLocFormat == 0) { for ($i = 0; $i <= $numGlyphs; $i++) { $length += $font->writeUInt16($data[$i] / 2); } } else { if ($indexToLocFormat == 1) { for ($i = 0; $i <= $numGlyphs; $i++) { $length += $font->writeUInt32($data[$i]); } } } return $length; } }