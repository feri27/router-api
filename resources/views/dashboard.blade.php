<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 bg-white border-b border-gray-200">

                    <table class="w-full table-responsive">
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-6 py-4">#</td>
                                <td class="border px-6 py-4">DATE/TIME</td>
                                <td class="border px-6 py-4">MAC</td>
                                <td class="border px-6 py-4">RSSI</td>
                                <td class="border px-6 py-4">CHANNEL</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $value)
                                
                            <tr>
                                <td class="border px-6 py-4">{{$loop->iteration}}</td>
                                <td class="border px-6 py-4">{{$value['date']}}</td>
                                <td class="border px-6 py-4">{{$value['mac']}}</td>
                                <td class="border px-6 py-4">{{$value['rssi']}}</td>
                                <td class="border px-6 py-4">{{$value['chanel']}}</td>
                            </tr>
                          

                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
