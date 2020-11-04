<?php
 namespace Dompdf\FrameReflower; use Dompdf\Helpers; use Dompdf\FrameDecorator\Block as BlockFrameDecorator; use Dompdf\FrameDecorator\Image as ImageFrameDecorator; class Image extends AbstractFrameReflower { function __construct(ImageFrameDecorator $frame) { parent::__construct($frame); } function reflow(BlockFrameDecorator $block = null) { $this->_frame->position(); $this->get_min_max_width(); if ($block) { $block->add_frame_to_line($this->_frame); } } function get_min_max_width() { if ($this->get_dompdf()->getOptions()->getDebugPng()) { list($img_width, $img_height) = Helpers::dompdf_getimagesize($this->_frame->get_image_url(), $this->get_dompdf()->getHttpContext()); print "get_min_max_width() " . $this->_frame->get_style()->width . ' ' . $this->_frame->get_style()->height . ';' . $this->_frame->get_parent()->get_style()->width . " " . $this->_frame->get_parent()->get_style()->height . ";" . $this->_frame->get_parent()->get_parent()->get_style()->width . ' ' . $this->_frame->get_parent()->get_parent()->get_style()->height . ';' . $img_width . ' ' . $img_height . '|'; } $style = $this->_frame->get_style(); $width_forced = true; $height_forced = true; $width = ($style->width > 0 ? $style->width : 0); if (Helpers::is_percent($width)) { $t = 0.0; for ($f = $this->_frame->get_parent(); $f; $f = $f->get_parent()) { $f_style = $f->get_style(); $t = $f_style->length_in_pt($f_style->width); if ($t != 0) { break; } } $width = ((float)rtrim($width, "%") * $t) / 100; } else { $width = $style->length_in_pt($width); } $height = ($style->height > 0 ? $style->height : 0); if (Helpers::is_percent($height)) { $t = 0.0; for ($f = $this->_frame->get_parent(); $f; $f = $f->get_parent()) { $f_style = $f->get_style(); $t = $f_style->length_in_pt($f_style->height); if ($t != 0) { break; } } $height = ((float)rtrim($height, "%") * $t) / 100; } else { $height = $style->length_in_pt($height); } if ($width == 0 || $height == 0) { list($img_width, $img_height) = Helpers::dompdf_getimagesize($this->_frame->get_image_url(), $this->get_dompdf()->getHttpContext()); if ($width == 0 && $height == 0) { $dpi = $this->_frame->get_dompdf()->getOptions()->getDpi(); $width = (float)($img_width * 72) / $dpi; $height = (float)($img_height * 72) / $dpi; $width_forced = false; $height_forced = false; } elseif ($height == 0 && $width != 0) { $height_forced = false; $height = ($width / $img_width) * $img_height; } elseif ($width == 0 && $height != 0) { $width_forced = false; $width = ($height / $img_height) * $img_width; } } if ($style->min_width !== "none" || $style->max_width !== "none" || $style->min_height !== "none" || $style->max_height !== "none" ) { list( , , $w, $h) = $this->_frame->get_containing_block(); $min_width = $style->length_in_pt($style->min_width, $w); $max_width = $style->length_in_pt($style->max_width, $w); $min_height = $style->length_in_pt($style->min_height, $h); $max_height = $style->length_in_pt($style->max_height, $h); if ($max_width !== "none" && $width > $max_width) { if (!$height_forced) { $height *= $max_width / $width; } $width = $max_width; } if ($min_width !== "none" && $width < $min_width) { if (!$height_forced) { $height *= $min_width / $width; } $width = $min_width; } if ($max_height !== "none" && $height > $max_height) { if (!$width_forced) { $width *= $max_height / $height; } $height = $max_height; } if ($min_height !== "none" && $height < $min_height) { if (!$width_forced) { $width *= $min_height / $height; } $height = $min_height; } } if ($this->get_dompdf()->getOptions()->getDebugPng()) print $width . ' ' . $height . ';'; $style->width = $width . "pt"; $style->height = $height . "pt"; $style->min_width = "none"; $style->max_width = "none"; $style->min_height = "none"; $style->max_height = "none"; return array($width, $width, "min" => $width, "max" => $width); } } 