<?php

namespace Phx\Atom\Heading;

use Phx\Core\Component;
use Phx\Core\Render;

final class Heading extends Component
{
	final public static function render(HeadingProps $props): Render
	{
		$common_props = $props->common;
		$content = $props->content;
		$sub_role = $props->sub_role;
		$color = $props->color->getForeground();
		$level = $props->level;
		$role = $props->role->getTypographyRole();

		$level_name = $level->value;
		$color_name = $color->value;

		$typography_css = self::getTypographyCss(
			role: $role,
			sub_role: $sub_role,
		);
		$typography_classes = $typography_css->classes;
		$typography_class_names = array_keys($typography_classes);

		$palette_css = self::getPaletteCss(color: $color);
		$color_class = [$color_name => $palette_css];

		$class_names = [
			...$typography_class_names,
			$color_name,
		];

		$attributes = self::makeAttributes(
			props: $common_props,
			classes: $class_names,
		);

		$html = <<<HTML
		<$level_name$attributes>$content</$level_name>
		HTML;

		$typos = $typography_css->fonts;
		$classes = [
			...$typography_classes,
			...$color_class,
		];

		$render = new Render(
			html: $html,
			typos: $typos,
			classes: $classes,
		);

		return $render;
	}
}
