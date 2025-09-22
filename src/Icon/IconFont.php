<?php

namespace Phx\Atom\Icon;

final class IconFont
{
	final public function __construct(
		/** @var FontSource[] $sources */
		public array $sources,
		public string $name,
		public string $family,
		public string $fill,
		public string $grade,
	) {}
}
