@extends('layouts.app')

@section('app-content')

    @if (Route::is('message.datas'))
                        <div class="row gap-20">
                            <div class="masonry-sizer col-md-6"></div>
                        </div>
    @else
                        <div class="row gap-20">
                            <div class="masonry-sizer col-lg-12"></div>
                            <!-- #Add a member ==================== -->
                            <div class="masonry-item col-lg-4">
                                <div class="layers bd bgc-white p-10">
                                    <div class="layer w-100 p-20">
                                        <h6 class="lh-1 m-0">@lang('miscellaneous.manager.member.add')</h6>
                                    </div>

                                    <div class="layer w-100">

                                    </div>
                                </div>
                            </div>

                            <!-- #Members list ==================== -->
                            <div class="masonry-item col-lg-8">
                                <div class="layers bd bgc-white p-10">
                                    <div class="layer w-100 p-20">
                                        <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.new_members.title')</h6>
                                    </div>

                                    <div class="layer w-100">
                                        <div class="table-responsive p-20">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="bdwT-0 fw-bold">@lang('miscellaneous.names')</th>
                                                        <th class="bdwT-0 fw-bold">@lang('miscellaneous.phone')</th>
                                                        <th class="bdwT-0 fw-bold">@lang('miscellaneous.admin.miscellaneous.role.title')</th>
                                                        <th class="bdwT-0 fw-bold">@lang('miscellaneous.admin.miscellaneous.status.title')</th>
                                                        <th class="bdwT-0 fw-bold">#</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="updateMemberStatus">
            @forelse ($users_not_developer as $user)
                                                    <tr>
                                                        <td class="fw-600"><p class="m-0 text-truncate"><a href="{{ route('party.member.datas', ['id' => $user->id]) }}">{{ $user->firstname }}</a></p></td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>
                                                            <select name="select_role" id="role_user-{{ $user->id }}" class="form-select shadow-0" onchange="changeRole('role_user-{{ $user->id }}')">
                                                                <option class="small" selected disabled>@lang('miscellaneous.choose_role')</option>
                @forelse ($roles as $role)
                    @if ($role->role_name != 'Administrateur' && $role->role_name != 'Développeur')
                                                                <option value="{{ $role->id }}"{{ $role->id == $user->role_user->role->id ? ' selected' : '' }}>{{ $role->role_name }}</option>
                    @endif
                @empty
                                                                <option>@lang('miscellaneous.empty_list')</option>
                @endforelse
                                                            </select>
                                                        </td>
                                                        <td><span class="badge bgc-{{ $user->status->color }}-50 c-{{ $user->status->color }}-700 p-10 lh-0 tt-c rounded-pill">{{ $user->status->status_name }}</span></td>
                                                        <td>
                                                            <div id="status_user-{{ $user->id }}" class="form-check form-switch" aria-current="{{ $user->status->status_name }}" onchange="changeStatus('status_user-{{ $user->id }}')">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="{{ $user->id }}" {{ $user->status->status_name == 'Activé' ? 'checked' : '' }} />
                                                                <label class="ms-2 form-check-label" for="{{ $user->id }}">{{ $user->status->status_name != 'Activé' ? __('miscellaneous.activate') : __('miscellaneous.lock') }}</label>
                                                            </div>
                                                        </td>
                                                    </tr>
            @empty
            @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    @endif

@endsection
