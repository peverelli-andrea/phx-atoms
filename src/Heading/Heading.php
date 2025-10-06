<?php

namespace Phx\Atom\Heading;

use Phx\Core\Component;
use Phx\Core\Render;
use Phx\Core\Palette;

final class Heading extends Component
{
	final public static function render(HeadingProps $props): Render
	{
		$common_props = $props->common;
		$content = $props->content;
		$sub_role = $props->sub_role;
		$level = $props->level;
		$role = $props->role->getTypographyRole();
		$color = $props->color;

		if($color instanceof Palette) {
			$color = $color->getForeground();
		}

		$level_name = $level->value;

		$color_name = self::getColorName(color: $color);
		$color_value = self::getColorValue(color: $color);

		$color_class_name = "atom_heading_$color_name";
		$color_css = <<<CSS
		.$color_class_name {
			color: $color_value;
		}
		CSS;

		$color_classes = [$color_class_name => $color_css];

		$typography_css = self::getTypographyCss(
			role: $role,
			sub_role: $sub_role,
		);
		$typography_classes = $typography_css->classes;
		$typography_class_names = array_keys($typography_classes);

		$class_names = [
			...$typography_class_names,
			$color_class_name,
		];

		$attributes = self::makeAttributes(
			props: $common_props,
			classes: $class_names,
		);

		$html = <<<HTML
		<$level_name$attributes>$content</$level_name>
		HTML;

		$typos = $typography_css->fonts;
		$colors = [$color_name => $color];
		$classes = [
			...$typography_classes,
			...$color_classes,
		];

		$render = new Render(
			html: $html,
			typos: $typos,
			colors: $colors,
			classes: $classes,
		);

		return $render;
	}
}
