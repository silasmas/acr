@extends('layouts.app')

@section('app-content')

                        <div class="row gap-20">
                            <!-- #Membership card ==================== -->
                            <div class="col-lg-4 col-md-5">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.membership_card.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #Personal Infos ==================== -->
                            <div class="col-lg-8 col-md-7">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.personal_infos.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #Change password ==================== -->
                            <div class="col-lg-8 col-md-7">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.update_password.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #Identity document ==================== -->
                            <div class="col-lg-4 col-md-5">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.identity_document.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #New contribution ==================== -->
                            <div class="col-lg-7 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.my_contributions.send_money.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- #My contributions ==================== -->
                            <div class="col-lg-5 col-md-6">
                                <div class="bd bgc-white">
                                    <div class="layers">
                                        <div class="layer d-flex w-100 pX-20 pT-20 justify-content-between">
                                            <h6 class="lh-1 m-0">@lang('miscellaneous.account.my_contributions.title')</h6>
                                        </div>

                                        <div class="layer w-100 pX-20 pT-10 pB-20">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

@endsection
