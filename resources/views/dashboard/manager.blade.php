@extends('layouts.app')

@section('app-content')

                        <div class="row gap-10">
                            <!-- #Managers list ==================== -->
                            <div class="masonry-item col-lg-8 col-md-10 mx-auto">
                                <div class="layers bgc-white p-0">
                                    <div class="layer w-100">
                                        <a href="{{ route('manager') }}" class="btn btn-block btn-primary btn-color rounded-0 text-start shadow-0">
                                            <span class="bi bi-arrow-left me-2"></span> @lang('miscellaneous.back_home')
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="masonry-item col-lg-8 col-md-10 mx-auto">
                                <div class="layers bd bgc-white p-10">
                                    <div class="layer w-100 p-20">
                                        <h6 class="lh-1 m-0">@lang('miscellaneous.manager.home.other_managers.title')</h6>
                                    </div>

                                    <div class="layer w-100">
                                        <div class="table-responsive p-20">
                                            <table id="dataList" class="table">
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
    @forelse ($managers as $user)
        @if ($user->id != $current_user->id)
                                                    <tr>
                                                        <td class="fw-600">
                                                            <p class="m-0 text-truncate"><a href="{{ route('party.manager.datas', ['id' => $user->id]) }}">{{ $user->firstname }}</a></p>
                                                        </td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>
                                                            <select name="select_role" id="role_user-{{ $user->id }}" class="form-control shadow-0" onchange="changeRole('role_user-{{ $user->id }}')">
                                                                <option class="small" selected disabled>@lang('miscellaneous.choose_role')</option>
            @forelse ($roles as $role)
                @if ($role->role_name != 'Administrateur' && $role->role_name != 'Développeur')
                                                                <option value="{{ $role->id }}" {{ $role->id == $user->role_user->role->id ? ' selected' : '' }}>{{ $role->role_name }}</option>
                @endif
            @empty
                                                                <option>@lang('miscellaneous.empty_list')</option>
            @endforelse
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <span class="badge bgc-{{ $user->status->color }}-50 c-{{ $user->status->color }}-700 p-10 lh-0 tt-c rounded-pill">{{ $user->status->status_name }}</span></td>
                                                        <td>
                                                            <div id="status_user-{{ $user->id }}" class="form-check form-switch" aria-current="{{ $user->status->status_name }}" onchange="changeStatus('status_user-{{ $user->id }}')">
                                                                <input type="checkbox" role="switch" id="{{ $user->id }}" class="form-check-input" {{ $user->status->status_name == 'Activé' ? 'checked' : '' }} />
                                                                <label for="{{ $user->id }}" class="ms-2 form-check-label">{{ $user->status->status_name != 'Activé' ? __('miscellaneous.activate') : __('miscellaneous.cancel') }}</label>
                                                            </div>
                                                        </td>
                                                    </tr>
        @endif
    @empty
    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

@endsection
