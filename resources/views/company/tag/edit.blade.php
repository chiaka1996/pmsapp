@extends('layouts.app')
@section('title', 'Tag')
@section('page', 'Tag Management')
@section('content')

    <div class="font-big text-big text-natural mb-2 flex flex-row justify-between">
        <div>Add New Tag</div>
        <a
            class="font-big text-normal text-primary_color rounded-lg border border-primary_color px-[16px] py-[10px] cursor-pointer bg-transparent"
            href="{{route('company.tags.index')}}"
        >
            Manage Tags
        </a>
    </div>
    <form class="mt-[2%] w-[100%]" action="{{route('company.tags.update',  ['tag' => $tag])}}" method="post">
        @csrf
        @method('PATCH')
        <div class="flex flex-row justify-between mb-2 max-lg:flex-col">
            <div class="w-[45%] max-lg:w-full mb-2">
                <x-input-label for="name" :value="__('Tag Name')"/>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="tag_name" :value="$tag->name"
                              required/>
                <x-input-error :messages="$errors->get('tag_name')" class="mt-2"/>
            </div>
            <div class="w-[45%] max-lg:w-full">
                <x-input-label for="site_id" :value="__('Select site')"/>
                <x-select-input id="site_id" class="block mt-1 w-full" name="site" required>
                    <option>Select Site</option>
                    @foreach($sites as $site)
                        <option value="{{$site->id}}" {{$tag->site_id == $site->id ? 'selected' : ''}}>{{$site->name}}</option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('site')" class="mt-2"/>

            </div>
        </div>

        {{--        <div class="w-full  mb-2">--}}
        {{--            <label class="font-big text-normal text-natural">Tag Type</label>--}}
        {{--            <select--}}
        {{--                class="outline-none w-full border border-natural bg-db h-[44px] px-2 py-1 rounded-lg text-white font-normal text-natural">--}}
        {{--                <option class=""></option>--}}
        {{--                <option>tag type</option>--}}
        {{--                <option>tag type</option>--}}
        {{--                <option>tag type</option>--}}
        {{--            </select>--}}
        {{--        </div>--}}

        <div class="w-full  mb-2">
            <x-input-label for="site_id" :value="__('Comment')"/>
            <x-text-area-input for="site_id" name='comment' value="{{$tag->comment}}"/>
            <x-input-error :messages="$errors->get('comment')" class="mt-2"/>
        </div>


        <div class="w-full mb-2">
            <x-input-label for="location" :value="__('Search Location')"/>
            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')"/>
            <x-input-error :messages="$errors->get('location')" class="mt-2"/>
        </div>
        <div class="flex flex-row justify-between mb-2 max-lg:flex-col">
            <div class="w-[48%] max-lg:w-full max-lg:mb-2">
                <x-input-label for="longitude" :value="__('Longitude')"/>
                <x-text-input id="longitude" class="block mt-1 w-full" type="number" name="longitude" :value="$tag->longitude"/>
                <x-input-error :messages="$errors->get('longitude')" class="mt-2"/>
            </div>
            <div class="w-[48%] max-lg:w-full">
                <x-input-label for="latitude" :value="__('Latitude')"/>
                <x-text-input id="latitude" class="block mt-1 w-full" type="number" name="latitude" :value="$tag->latitude"/>
                <x-input-error :messages="$errors->get('latitude')" class="mt-2"/>
            </div>
        </div>
        <div class="w-full mb-2">
            <div id="searchLocationMap" style="height: 400px; width: 100%;"></div>
        </div>
        <button class="mt-[1%] w-[60px] h-[40px] bg-primary_color rounded-lg text-normal text-natural font-big"
                type="submit">Update
        </button>
    </form>

@endsection
