@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-8 lg:px-8 py-8">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="delete_logo" id="delete_logo" value="0">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                    <div class="lg:col-span-1 bg-slate-50 border-r border-slate-200 p-6 sm:p-8">
                        <div class="relative">
                            <input type="file" id="logo" name="logo" accept="image/png, image/jpeg, image/jpg"
                                   class="hidden">
                            <div id="upload-placeholder"
                                 class="{{ $team->logo ? 'hidden' : 'flex' }} group flex-col items-center justify-center w-full aspect-square border-2 border-dashed border-slate-300 rounded-xl bg-white hover:bg-blue-50/50 hover:border-blue-400 cursor-pointer transition-all duration-200">
                                <div
                                    class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-3 text-blue-600 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                </div>
                                <span class="text-sm font-bold text-slate-700">Logonı saylań</span>
                                <span class="text-[11px] font-medium text-slate-400 mt-1 uppercase tracking-wide">PNG, JPG (Max. 4MB)</span>
                            </div>

                            <div id="image-preview-container"
                                 class="relative {{ $team->logo ? 'block' : 'hidden' }} rounded-xl overflow-hidden aspect-square border border-slate-200 group">
                                <img id="logo-preview" src="{{ $team->logo ? asset($team->logo) : '' }}" alt="Preview"
                                     class="w-full h-full object-cover">

                                <div
                                    class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                                    <button type="button" id="change-image-btn"
                                            class="w-10 h-10 rounded-full bg-white text-slate-700 hover:text-blue-600 flex items-center justify-center shadow-lg transition-transform hover:scale-110"
                                            title="Ózgertiw">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button type="button" id="remove-image-btn"
                                            class="w-10 h-10 rounded-full bg-rose-500 text-white hover:bg-rose-600 flex items-center justify-center shadow-lg transition-transform hover:scale-110"
                                            title="Óshiriw">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @error('logo')
                        <p class="mt-2 text-xs font-bold text-rose-500 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="lg:col-span-2 p-6 sm:p-8">
                        <h3 class="text-base font-black text-slate-900 mb-6 flex items-center gap-2">
                            Tiykarǵı maǵlıwmatlar
                        </h3>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-bold text-slate-700 mb-1.5">
                                        Komanda ataması <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $team->name) }}"
                                           required placeholder="Mısálı: Tigers"
                                           class="w-full rounded-xl border-slate-300 bg-slate-50/50 px-4 py-2.5 text-slate-900 text-sm focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none placeholder:text-slate-400">
                                    @error('name')
                                    <p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tag" class="block text-sm font-bold text-slate-700 mb-1.5">
                                        TEG (3 háripli) <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" id="tag" name="tag" value="{{ old('tag', $team->tag) }}" required
                                           maxlength="3" placeholder="TIG"
                                           class="w-full rounded-xl border-slate-300 bg-slate-50/50 px-4 py-2.5 text-slate-900 text-sm focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none uppercase placeholder:text-slate-400">
                                    @error('tag')
                                    <p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="form_id" class="block text-sm font-bold text-slate-700 mb-1.5">
                                    Qatnasıw forması
                                    <span class="text-rose-500">*</span></label>
                                <select id="form_id" name="form_id" required
                                        class="w-full rounded-xl border-slate-300 bg-slate-50/50 px-4 py-2.5 text-slate-900 text-sm focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none">
                                    <option value="" disabled>Qatnasıw formasın tańlań...</option>
                                    @foreach($universities as $university)
                                        <option
                                            value="{{ $university->id }}" {{ old('form_id', $team->form_id) == $university->id ? 'selected' : '' }}>
                                            {{ $university->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('form_id')
                                <p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <hr class="border-slate-100 my-2">

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-1.5">
                                    Mırátnama siltemesi (Join URL)
                                </label>
                                <p class="text-xs text-slate-500 mb-3 font-medium">
                                    Usı siltemeni basqalarǵa jiberiw arqalı komandaǵa qosıwıńız múmkin.
                                </p>
                                <div class="flex items-center gap-2">
                                    <input type="text" readonly value="{{ url('/join/' . $team->join_url) }}"
                                           class="w-full rounded-xl border-slate-200 bg-slate-100 px-4 py-2.5 text-slate-600 font-medium cursor-not-allowed outline-none select-all text-sm">
                                    <button type="button"
                                            onclick="navigator.clipboard.writeText('{{ url('/join/' . $team->join_url) }}');"
                                            class="shrink-0 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-sm rounded-xl border border-slate-200 transition-colors"
                                            title="Nusxa alıw">
                                        <i class="fa-regular fa-copy"></i>
                                    </button>

                                    <button type="button"
                                            onclick="if(confirm('Siltemeni jańalawdı qáleysizbe? Eski silteme islemey qoladı!')) { document.getElementById('regenerate-form').submit(); }"
                                            class="shrink-0 px-4 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-sm rounded-xl border border-rose-200 transition-colors group"
                                            title="Jańa silteme jaratıw">
                                        <i class="fa-solid fa-rotate-right group-hover:rotate-180 transition-transform duration-500"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 border-t border-slate-100 p-6 flex items-center justify-end gap-3">
                    <a href="{{ route('home') }}"
                       class="px-5 py-2.5 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors shadow-sm">
                        Biykarlaw
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 hover:shadow-md hover:shadow-blue-500/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        Ózgerislerdi saqlaw
                    </button>
                </div>
            </form>

            <form id="regenerate-form" action="{{ route('teams.regenerate_join_url', $team->id) }}" method="POST"
                  class="hidden">
                @csrf
                @method('PATCH')
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('logo');
            const deleteLogoInput = document.getElementById('delete_logo');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const previewContainer = document.getElementById('image-preview-container');
            const logoPreview = document.getElementById('logo-preview');
            const removeBtn = document.getElementById('remove-image-btn');
            const changeBtn = document.getElementById('change-image-btn');
            if (uploadPlaceholder) {
                uploadPlaceholder.addEventListener('click', () => fileInput.click());
            }
            if (changeBtn) {
                changeBtn.addEventListener('click', () => fileInput.click());
            }
            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            logoPreview.src = e.target.result;
                            uploadPlaceholder.classList.add('hidden');
                            uploadPlaceholder.classList.remove('flex');
                            previewContainer.classList.remove('hidden');
                            previewContainer.classList.add('block');
                        }
                        reader.readAsDataURL(this.files[0]);
                        deleteLogoInput.value = '0';
                    }
                });
            }
            if (removeBtn) {
                removeBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    fileInput.value = '';
                    logoPreview.src = '';
                    previewContainer.classList.add('hidden');
                    previewContainer.classList.remove('block');
                    uploadPlaceholder.classList.remove('hidden');
                    uploadPlaceholder.classList.add('flex');
                    deleteLogoInput.value = '1';
                });
            }
        });
    </script>
@endsection
