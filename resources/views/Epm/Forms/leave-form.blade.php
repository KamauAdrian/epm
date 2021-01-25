@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Employee Leave Form</h1>
                        </div>
                        <form action="#!" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>The annual leave entitlement is in accordance with Kenya labour law. As an Employee of eMobilis you are entitled to twenty-one (21) working days of leave plus any public holidays in compliance with Kenya Labour Laws.</p>
                                    <br />
                                    <p>According to Section 29 of Employment Act, 2007, female employees shall be entitled to 3 Calendar months maternity leave on full pay in addition to any period of annual leave.</p>
                                    <br />
                                    <p>Male employees shall be entitled 2 Calendar weeks paternity leave with full pay. And it cannot be extended without salary deduction.  The employee shall be required to produce a certificate of the expectant partner medical condition from a qualified medical practitioner or midwife.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
