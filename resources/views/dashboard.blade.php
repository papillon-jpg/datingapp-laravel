<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Početna • Statistika
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Top kartice --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Ukupno profila</div>
                    <div class="text-3xl font-extrabold mt-1">{{ $total }}</div>
                    <div class="text-xs text-gray-400 mt-2">U sistemu</div>
                </div>

                <div class="bg-white shadow sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Prosječne godine</div>
                    <div class="text-3xl font-extrabold mt-1">
                        {{ $avgAge !== null ? $avgAge : '—' }}
                    </div>
                    <div class="text-xs text-gray-400 mt-2">
                        Min: {{ $minAge ?? '—' }} • Max: {{ $maxAge ?? '—' }}
                    </div>
                </div>

                <div class="bg-white shadow sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500">Najčešći grad</div>
                    <div class="text-3xl font-extrabold mt-1">
                        {{ $topCity?->grad ?? '—' }}
                    </div>
                    <div class="text-xs text-gray-400 mt-2">
                        {{ $topCity ? $topCity->total.' profila' : 'Nema podataka' }}
                    </div>
                </div>
            </div>

            {{-- Spol --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold">Spol</h3>
                    <div class="text-sm text-gray-500">Postotci</div>
                </div>

                <div class="mt-6 space-y-4">
                    {{-- Muško --}}
                    <div>
                        <div class="flex justify-between text-sm">
                            <span class="font-medium">Muško</span>
                            <span class="text-gray-600">{{ $maleCount }} ({{ $malePct }}%)</span>
                        </div>
                        <div class="h-3 bg-gray-100 rounded-full mt-2 overflow-hidden">
                            <div class="h-full bg-pink-600" style="width: {{ $malePct }}%"></div>
                        </div>
                    </div>

                    {{-- Žensko --}}
                    <div>
                        <div class="flex justify-between text-sm">
                            <span class="font-medium">Žensko</span>
                            <span class="text-gray-600">{{ $femaleCount }} ({{ $femalePct }}%)</span>
                        </div>
                        <div class="h-3 bg-gray-100 rounded-full mt-2 overflow-hidden">
                            <div class="h-full bg-pink-400" style="width: {{ $femalePct }}%"></div>
                        </div>
                    </div>

                    {{-- Ostalo --}}
                    <div>
                        <div class="flex justify-between text-sm">
                            <span class="font-medium">Ostalo</span>
                            <span class="text-gray-600">{{ $otherCount }} ({{ $otherPct }}%)</span>
                        </div>
                        <div class="h-3 bg-gray-100 rounded-full mt-2 overflow-hidden">
                            <div class="h-full bg-gray-400" style="width: {{ $otherPct }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dobne grupe + Gradovi --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Dobne grupe --}}
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold">Dobne grupe</h3>

                    @php $ageTotal = array_sum($ageBuckets); @endphp

                    <div class="mt-6 space-y-4">
                        @foreach($ageBuckets as $label => $count)
                            @php
                                $pct = $ageTotal ? round(($count / $ageTotal) * 100) : 0;
                            @endphp
                            <div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium">{{ $label }}</span>
                                    <span class="text-gray-600">{{ $count }} ({{ $pct }}%)</span>
                                </div>
                                <div class="h-3 bg-gray-100 rounded-full mt-2 overflow-hidden">
                                    <div class="h-full bg-pink-500" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach

                        @if($ageTotal === 0)
                            <p class="text-sm text-gray-500">Nema unesenih datuma rođenja.</p>
                        @endif
                    </div>
                </div>

                {{-- Top gradovi --}}
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold">Top gradovi</h3>

                    @php $cityMax = $topCities->max('total') ?? 0; @endphp

                    <div class="mt-6 space-y-4">
                        @forelse($topCities as $c)
                            @php
                                $pct = $cityMax ? round(($c->total / $cityMax) * 100) : 0;
                            @endphp
                            <div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium">{{ $c->grad }}</span>
                                    <span class="text-gray-600">{{ $c->total }}</span>
                                </div>
                                <div class="h-3 bg-gray-100 rounded-full mt-2 overflow-hidden">
                                    <div class="h-full bg-pink-600" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Nema gradova u bazi.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<div class="bg-white shadow sm:rounded-lg p-6 mt-6">
  <h3 class="text-lg font-bold mb-4">🗺️ Gdje su naši korisnici</h3>
  <div id="map" class="w-full rounded-2xl" style="height: 380px;"></div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const markers = @json($markers);

  const map = L.map('map').setView([44.2, 17.9], 7); // BiH centar (možeš promijeniti)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  markers.forEach(p => {
    L.marker([p.lat, p.lng]).addTo(map)
      .bindPopup(`<b>${p.ime}</b><br>${p.grad}`);
  });
</script>
</x-app-layout>