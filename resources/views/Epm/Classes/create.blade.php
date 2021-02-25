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
                            <h1 class="f-w-400">Create a New Class</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/class')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{old('name')}}">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="classCategory">
                                        <label>Category</label>
                                        <category v-model="selectedCategory" :options="categories"
                                                  placeholder="Search"
                                                  :searchable="true" :close-on-select="true">
                                        </category>
                                        <input type="hidden" name="category" :value="selectedCategory">
                                        <span class="text-danger">{{$errors->first('category')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Class Description</label>
                                        <textarea name="description" class="form-control" placeholder="Short Team Description" cols="30" rows="5">{{old('description')}}</textarea>
                                        <span class="text-danger">{{$errors->first('description')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-info btn-lg mb-3">Create Class</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
    <script>
        new Vue({
            el: '#classCategory',
            components: {
                category: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCategory: null,
                    categories: [
                        'Data Entry/Management','Virtual Assistant','Transcription',
                        'Digital Marketing/Ecommerce','Content Writing and Translation'
                    ],
                }
            },
            methods:{
            },
        })
    </script>
@endsection
