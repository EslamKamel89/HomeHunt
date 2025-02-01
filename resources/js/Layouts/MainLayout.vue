<template>
    <div class="light container mx-auto max-w-5xl">
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl">HomeHunt</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><Link href="/">Home Page</Link></li>
                    <li>
                        <details>
                            <summary>Listing</summary>
                            <ul class="rounded-t-none bg-base-100 p-2">
                                <li>
                                    <Link :href="route('listing.index')"
                                        >View</Link
                                    >
                                </li>
                                <li>
                                    <Link :href="route('listing.create')"
                                        >Add</Link
                                    >
                                </li>
                            </ul>
                        </details>
                    </li>
                </ul>
            </div>
        </div>
        <main class="px-8">
            <slot></slot>
        </main>
    </div>
</template>
<script setup lang="ts"></script>
