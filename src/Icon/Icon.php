<?php

namespace Phx\Atom\Icon;

use Phx\Core\Component;
use Phx\Core\Render;
use Phx\Core\FontSource;
use Phx\Core\TypographyWeight;
use Phx\Core\CssColorProperty;
use Phx\Core\ColorType;

final class Icon extends Component
{
	final public function __construct() {}

	final public function render(IconProps $props): Render
	{
		$this->registerCommonProps(common_props: $props->common);

		$this->addColor(
			color: $props->color,
			css_color_property: CssColorProperty::COLOR,
			color_type: ColorType::FOREGROUND,
		);

		$icon_css = self::getIconCss(
			variant: $props->variant,
			size: $props->size,
			style: $props->style,
			weight: $props->weight,
			with_copy: $props->with_copy,
		);
		array_push($this->typos, ...$icon_css->fonts);
		array_push($this->classes, ...$icon_css->classes);

		$this->addClasses(class_names: array_keys($icon_css->classes));

		$attributes = $this->makeAttributes();

		return $this->makeRender(
			html: <<<HTML
			<span$attributes>{$props->variant->value}</span>
			HTML,
		);
	}

	private static function getIconCss(
		IconVariant $variant,
		IconSize $size,
		IconStyle $style,
		TypographyWeight $weight,
		bool $with_copy,
	): IconCss
	{
		$variant_name = $variant->value;
		$size_value = $size->value;
		$style_name = $style->value;
		$weight_value = $weight->value;

		$icon_font = self::getIconFont(
			variant: $variant,
			style: $style,
		);
		$icon_sources = $icon_font->sources;
		$family = $icon_font->family;
		$fill = $icon_font->fill;
		$grade = $icon_font->grade;

		$sources_css = [];
		foreach($icon_sources as $icon_source) {
			$source = $icon_source->source;
			$format = $icon_source->format;
			$tech = $icon_source->tech;

			if($format !== "local"){
				if($tech !== null) {
					$source_css = <<<CSS
					url("/assets/fonts/icons/$style_name/$source") format("$format") tech("$tech")
					CSS;
				} else {
					$source_css = <<<CSS
					url("/assets/fonts/icons/$style_name/$source") format("$format")
					CSS;
				}
			} else {
				$source_css = <<<CSS
				local("$source")
				CSS;
			}

			array_push($sources_css, $source_css);
		}
		$sources_css = implode(',', $sources_css);

		$font_css = <<<CSS
		@font-face {
			font-family: $family;
			font-style: normal;
			font-weight: 100 700;
			src: $sources_css;
		}
		CSS;

		$class_css = <<<CSS
		.$family {
			font-family: $family;
			font-weight: $weight_value;
			font-style: normal;
			font-size: $size_value;
			line-height: 1;
			letter-spacing: normal;
			text-transform: none;
			display: inline-block;
			white-space: nowrap;
			word-wrap: normal;
			direction: ltr;
			-webkit-font-feature-settings: 'liga';
			-webkit-font-smoothing: antialiased;
			font-variation-settings:
				"FILL" $fill,
				"wght" $weight_value,
				"GRAD" $grade,
				"opsz" $size_value;
		}
		CSS;

		$fonts = [$family => $font_css];
		$classes = [$family => $class_css];

		$icon_css = new IconCss(
			fonts: $fonts,
			classes: $classes,
		);

		return $icon_css;
	}

	private static function getIconFont(
		IconVariant $variant,
		IconStyle $style,
	): IconFont
	{
		$variant_name = $variant->value;
		$style_name = $style->value;

		$settings_path = realpath($_SERVER["DOCUMENT_ROOT"] . "/../settings/icon/$style_name/$variant_name.json");

		$settings = json_decode(file_get_contents($settings_path));

		$settings_sources = $settings->sources;
		$name = $settings->name;
		$family = $settings->family;
		$fill = $settings->fill;
		$grade = $settings->grade;

		$sources = [];
		foreach($settings_sources as $settings_source) {
			$source = $settings_source->source;
			$format = $settings_source->format;
			$tech = $settings_source->tech ?? null;

			$font_source = new FontSource(
				source: $source,
				format: $format,
				tech: $tech,
			);

			array_push($sources, $font_source);
		}

		$icon_font = new IconFont(
			sources: $sources,
			name: $name,
			family: $family,
			fill: $fill,
			grade: $grade,
		);

		return $icon_font;
	}
}
