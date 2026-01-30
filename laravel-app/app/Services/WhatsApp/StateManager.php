<?php

namespace App\Services\WhatsApp;

use App\Models\Guest;
use Illuminate\Support\Facades\Cache;

class StateManager
{
    protected int $stateTTL = 3600; // 1 hour

    /**
     * Get current conversation state for guest
     *
     * @param Guest $guest
     * @return string
     */
    public function getState(Guest $guest): string
    {
        return Cache::get($this->getStateKey($guest), 'NEW');
    }

    /**
     * Set conversation state for guest
     *
     * @param Guest $guest
     * @param string $state
     * @return void
     */
    public function setState(Guest $guest, string $state): void
    {
        Cache::put($this->getStateKey($guest), $state, $this->stateTTL);
    }

    /**
     * Get conversation context data
     *
     * @param Guest $guest
     * @return array
     */
    public function getContext(Guest $guest): array
    {
        return Cache::get($this->getContextKey($guest), []);
    }

    /**
     * Set conversation context data
     *
     * @param Guest $guest
     * @param array $context
     * @return void
     */
    public function setContext(Guest $guest, array $context): void
    {
        Cache::put($this->getContextKey($guest), $context, $this->stateTTL);
    }

    /**
     * Update specific context field
     *
     * @param Guest $guest
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function updateContext(Guest $guest, string $key, $value): void
    {
        $context = $this->getContext($guest);
        $context[$key] = $value;
        $this->setContext($guest, $context);
    }

    /**
     * Clear conversation state and context
     *
     * @param Guest $guest
     * @return void
     */
    public function clearState(Guest $guest): void
    {
        Cache::forget($this->getStateKey($guest));
        Cache::forget($this->getContextKey($guest));
    }

    /**
     * Get cache key for state
     *
     * @param Guest $guest
     * @return string
     */
    protected function getStateKey(Guest $guest): string
    {
        return "whatsapp:state:{$guest->phone_number}";
    }

    /**
     * Get cache key for context
     *
     * @param Guest $guest
     * @return string
     */
    protected function getContextKey(Guest $guest): string
    {
        return "whatsapp:context:{$guest->phone_number}";
    }
}
