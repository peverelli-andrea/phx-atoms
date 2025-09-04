<?php

namespace Phx\Atom\Label;

use Phx\Core\Component;

final class LabelProps
{
	final public function __construct(
		public string $content = "",
	) {}
}
