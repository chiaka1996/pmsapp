@extends('layouts.app')
@section('title', 'Site Management')
@section('page', 'Site Management')
@push('header-links')
    <link rel="stylesheet" href="{{asset('assets/timepicker/jquery.timepicker.min.css')}}">
@endpush
@section('content')

    @include('company.site.change_password_modal', ['site' => $site])
    @include('company.site.change_logout_pin_modal',  ['site' => $site])


    <div class="font-big text-big text-natural mb-2 flex flex-row justify-between">
        <div>Edit Site ({{$site->name}})</div>

        <button
            class="font-big text-normal text-white rounded-lg border-none bg-red-700 px-[16px] py-[10px] cursor-pointer focus:outline-none text-white"
            id="show_change_password_dialog"
            data-modal-target="changePasswordModal"
            data-modal-toggle="changePasswordModal"
            {{--            onclick="showChangePasswordModal()"--}}
        >
            Change Site Password
        </button>
        <button
            class="font-big text-normal text-white rounded-lg px-[16px] py-[10px] cursor-pointer bg-yellow-500"
            data-modal-target="changeLogoutModal"
            data-modal-toggle="changeLogoutModal"
        >
            Change Site Logout Pin
        </button>
        <a
            class="font-big text-normal text-primary_color rounded-lg border border-primary_color px-[16px] py-[10px] cursor-pointer bg-transparent"
            href="{{route('company.sites.index')}}"
        >
            Manage Sites
        </a>
    </div>
    <form class="mt-[2%] w-[100%]" action="{{route('admin.sites.update',  ['site' => $site])}}" method="POST"
          enctype='multipart/form-data'>
        @csrf @method('PATCH')
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="flex flex-col">
                <x-input-label for="company_id" :value="__('Select Company')"/>
                <x-select-input id="company_id" class="block mt-1 w-full" name="company_id">
                    <option>Select Company</option>
                    @foreach($companies as $company)
                        <option
                            value="{{$company->id}}" {{$site->company_id ==  $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('company_id')" class="mt-2"/>
            </div>
            <div class="flex flex-col">
                <x-input-label for="status" :value="__('Status')"/>
                <x-select-input id="status" class="block mt-1 w-full" name="status">
                    <option>Select Status</option>
                    <option value="1" {{$site->status  == 1 ? 'selected' : ''}}>Active</option>
                    <option value="0" {{$site->status  == 0 ? 'selected' : ''}}>In Active</option>
                </x-select-input>
                <x-input-error :messages="$errors->get('status')" class="mt-2"/>
            </div>
        </div>

        <div class="grid gap-6 mb-4 md:grid-cols-2">
            <div class="flex flex-col">
                <x-input-label for="name" :value="__('Site Name')"/>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$site->name "
                              required/>
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>
            <div class="flex flex-col">
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="optional($site->inspector)->email "
                              required/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>
        </div>

        <div class="grid gap-6 mb-4 md:grid-cols-2">
            <div class="flex flex-col">
                <x-input-label for="address" :value="__('Address')"/>
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$site->address "
                              required/>
                <x-input-error :messages="$errors->get('address')" class="mt-2"/>
            </div>
            <div class="flex flex-col">
                <x-input-label for="state" :value="__('State')"/>
                <x-select-input id="state_id" class="block mt-1 w-full" name="state">
                    <option>Select State</option>
                    @foreach($states as $state)
                        <option
                            value="{{$state->id}}" {{$site->state_id  ==  $state->id ? 'selected' : ''}}>{{$state->name}}</option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('state')" class="mt-2"/>
            </div>
        </div>
        <div class="w-full  mb-4">
            <x-input-label for="photo" :value="__('Photo')"/>
            <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" accept="image/*"/>
            <x-input-error :messages="$errors->get('photo')" class="mt-2"/>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="flex flex-col">
                <x-input-label for="shift_start_time" :value="__('Shift start time')"/>
                <x-text-input class="block mt-1 w-full" type="time"
                              :value="$site->shift_start_time" name="shift_start_time"
                              required/>
                <x-input-error :messages="$errors->get('shift_start_time')" class="mt-2"/>
            </div>
            <div class="flex flex-col">
                <x-input-label for="shift_end_time" :value="__('Shift end time')"/>
                <x-text-input  class="block mt-1 w-full shift_end_time_timepicker" type="text"
                              name="shift_end_time" :value="$site->shift_end_time" required/>
                <x-input-error :messages="$errors->get('shift_end_time')" class="mt-2"/>
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="flex flex-col max-lg:mb-2">
                <x-input-label for="number_of_tags" :value="__('Number of Tags')"/>
                <x-text-input id="number_of_tags" class="block mt-1 w-full" type="number" name="number_of_tags"
                              :value="$site->number_of_tags" required/>
                <x-input-error :messages="$errors->get('number_of_tags')" class="mt-2"/>
            </div>
            <div class="flex flex-col">
                <x-input-label for="maximum_number_of_rounds" :value="__('Number of Rounds')"/>
                <x-text-input id="maximum_number_of_rounds" class="block mt-1 w-full" type="number"
                              name="maximum_number_of_rounds" required :value="$site->maximum_number_of_rounds"/>
                <x-input-error :messages="$errors->get('maximum_number_of_rounds')" class="mt-2"/>
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="flex flex-col">
                <x-input-label for="liveLocation" :value="__('Enable live location')"/>
                <x-select-input id="liveLocation" class="block mt-1 w-full" name="liveLocation">
                    <option>Select Option</option>
                    {{-- @foreach($states as $state)
                        <option
                            value="{{$state->id}}" {{old('state_id') ==  $state->id ? 'selected' : ''}}>{{$state->name}}</option>
                    @endforeach --}}
                </x-select-input>
                <x-input-error :messages="$errors->get('liveLocation')" class="mt-2"/>
            </div>
        </div>


        <div class="w-full mb-2">
            <x-input-label for="location" :value="__('Search Location')"/>
            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location"/>
            <x-input-error :messages="$errors->get('location')" class="mt-2"/>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div class="flex flex-col max-lg:mb-2">
                <x-input-label for="longitude" :value="__('Longitude')"/>
                <x-text-input id="longitude" class="block mt-1 w-full" type="number" name="longitude" readonly
                              :value="$site->longitude"/>
                <x-input-error :messages="$errors->get('longitude')" class="mt-2"/>
            </div>
            <div class="flex flex-col">
                <x-input-label for="latitude" :value="__('Latitude')"/>
                <x-text-input id="latitude" class="block mt-1 w-full" type="number" name="latitude" readonly
                              :value="$site->latitude"/>
                <x-input-error :messages="$errors->get('latitude')" class="mt-2"/>
            </div>
        </div>
        <div class="w-full mb-2">
            <div id="searchLocationMap" style="height: 400px; width: 100%;"></div>
        </div>


        <button class="mt-[1%] w-[60px] h-[40px] bg-primary_color rounded-lg text-normal text-natural font-big"
                type="submit">
            Update
        </button>
    </form>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{--    https://www.jqueryscript.net/demo/Customizable-jQuery-Timepicker-Plugin-timepicker/--}}
    <script src="{{asset('assets/timepicker/jquery.timepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('.shift_start_time_timepicker').timepicker({
                listWidth: 1
            });
            $('.shift_end_time_timepicker').timepicker({
                listWidth: 1
            });
        });
    </script>
@endpush
