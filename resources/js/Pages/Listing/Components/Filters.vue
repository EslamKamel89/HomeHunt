<template>
    <form>
        <div class="mb-8 mt-4 flex flex-wrap items-center justify-start gap-2">
            <div class="flex flex-nowrap items-center">
                <input
                    type="number"
                    class="w-[100px] rounded-s-md"
                    placeholder="Price from"
                />
                <input
                    type="number"
                    class="w-[100px] rounded-e-md"
                    placeholder="Price to"
                />
            </div>
            <div class="flex flex-nowrap items-center">
                <select class="w-[100px] rounded-s-md">
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :value="n" :key="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
                <select class="w-[100px] rounded-e-md">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :value="n" :key="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input
                    type="number"
                    class="w-[100px] rounded-s-md"
                    placeholder="Area from"
                />
                <input
                    type="number"
                    class="w-[100px] rounded-e-md"
                    placeholder="Area to"
                />
            </div>
            <div class="flex flex-nowrap">
                <button
                    type="submit"
                    class="text-whte w-[100px] rounded-s-md border border-blue-500 bg-blue-500 py-2 text-white"
                >
                    Find
                </button>
                <button
                    type="reset"
                    class="w-[100px] rounded-e-md border border-red-500 text-red-700"
                >
                    Clear
                </button>
            </div>
        </div>
    </form>
</template>
<script lang="ts" setup></script>
