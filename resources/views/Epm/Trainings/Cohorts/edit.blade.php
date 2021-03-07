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
                            <h1 class="f-w-400">Edit Cohort</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/update/cohort/'.$cohort->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group" id="cohortCategory">
                                        <label>Category</label>
                                        <category v-model="selectedCategory" :options="categories"
                                                  placeholder="Search"
                                                  :searchable="true" :close-on-select="true">
                                        </category>
                                        <input type="hidden" name="category" :value="selectedCategory">
                                        <input type="hidden" id="sCategory" value="{{$cohort->category}}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Cohort Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$cohort->name}}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Cohort Description</label>
                                        <textarea name="description" class="form-control" cols="30" rows="5">{{$cohort->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-info btn-lg mb-3">Update Cohort</button>
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
@section("js")
    <script>
        new Vue({
            el: '#cohortCategory',
            components: {
                category: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCategory: this.getCategory(),
                    categories: [
                        'Data Entry/Management','Virtual Assistant','Transcription',
                        'Digital Marketing/Ecommerce','Content Writing and Translation'
                    ],
                }
            },
            methods:{
                getCategory(){
                    return document.getElementById("sCategory").value;

                }
            },
        })
    </script>
@endsection
