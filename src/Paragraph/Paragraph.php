<?php

namespace Phx\Atom\Paragraph;

use Phx\Core\Component;
use Phx\Core\Render;
use Phx\Core\TypographyRole;

final class Paragraph extends Component
{
	final private function __construct() {}

	final public static function getName(): string
	{ return "atom/paragraph"; }

	final public static function render(ParagraphProps $props): Render
	{
		$content = $props->content;
		$sub_role = $props->sub_role;
		$sub_role_value = $sub_role->value;
		$color = $props->color->getForeground();
		$color_name = $color->value;

		$typography_css = self::getTypographyCss(
			role: TypographyRole::BODY,
			sub_role: $sub_role,
		);
		$typography_classes = $typography_css->classes;

		$palette_css = self::getPaletteCss(color: $color);

		$class_names = [
			...array_keys($typography_classes),
			$color_name
		];

		$common_props = $props->common;
		$attributes = self::makeAttributes(
			props: $common_props,
			classes: $class_names,
		);

		$html = <<<HTML
		<p$attributes>$content</p>
		HTML;

		$typos = $typography_css->fonts;
		$classes = [
			...$typography_classes,
			$color_name => $palette_css,
		];

		$render = new Render(
			html: $html,
			typos: $typos,
			classes: $classes,
		);

		return $render;
	}
}
