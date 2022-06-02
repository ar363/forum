<template>
    <div class="flex relative z-0 flex-col items-center pt-24 -mt-16 min-h-screen bg-gray-100 sm:justify-center sm:pt-16">
        <div>
            <slot name="logo" />
        </div>

        <div class="overflow-hidden px-6 py-4 mt-6 w-full bg-white shadow-md sm:max-w-md sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
