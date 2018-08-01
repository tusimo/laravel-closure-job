<?php
namespace Tusimo\ClosureJob;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Opis\Closure\SerializableClosure;

class ClosureJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $closureWrapper;

    public function __construct(\Closure $closure)
    {
        $this->closureWrapper = new SerializableClosure($closure);
    }

    public function handle()
    {
        $closure = $this->closureWrapper->getClosure();
        return value($closure);
    }
}
