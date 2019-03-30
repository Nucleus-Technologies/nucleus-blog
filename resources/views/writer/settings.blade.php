@extends('layouts.writer')

@section('content')
    
    <section class="profile container">
        
        <div class="row">
            
            <div class="four columns right">
                
                <div class="row config avatar_config">
                    
                    <div class="row config_title">
                        <span>Change your avatar</span>
                        <hr>
                    </div>
                    
                    <div class="row content avatar">
                        <form action="{{ route('writer.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <img class="avatar_btn" src="{{ asset($avatar) }}" alt="avatar" style="cursor: pointer">
                            <input type="file" accept="image/*" name="avatar" id="avatar" style="display: none;">
                        </form>
                    </div>
                    
                    <div class="row config_save">
                        <a href="#" class="save_btn">
                            Change your avatar
                            
                            <img src="/assets/img/green_arrow.svg" alt="arrow">
                        </a>
                    </div>
                
                </div>
                
                <div class="row config socials_config">
                    
                    <div class="row config_title">
                        <span>Socials</span>
                        <hr>
                    </div>
                    
                    <div class="row content socials">
                        
                        <form action="{{ route('writer.update') }}" method="POST">
    
                            @csrf
                            
                            <div class="row u-full-width">
                                <input type="text" name="linkedin" id="linkedin" placeholder="LinkedIn" value="{{ $writer->linkedin }}">
                            </div>
                            <div class="row u-full-width">
                                <input type="text" name="facebook" id="facebook" placeholder="Facebook" value="{{ $writer->facebook }}">
                            </div>
                            <div class="row u-full-width">
                                <input type="text" name="twitter" id="twitter" placeholder="Twitter" value="{{ $writer->twitter }}">
                            </div>
                        
                        </form>
                    
                    </div>
                    
                    <div class="row config_save">
                        <a href="#" class="save_btn">
                            Save
                            
                            <img src="/assets/img/green_arrow.svg" alt="arrow">
                        </a>
                    </div>
                
                </div>
            
            </div>
            
            <div class="eight columns">
                
                <div class="row config general_config">
                    
                    <div class="row config_title">
                        <span>General Informations</span>
                        <hr>
                    </div>
                    
                    <div class="row content general">
                        
                        <form action="{{ route('writer.update') }}" method="POST">
    
                            @csrf
                            
                            <div class="row u-full-width">
                                <div class="six columns">
                                    <input type="text" name="first_name" id="first_name" placeholder="First name" value="{{ $writer->first_name }}">
                                </div>
                                <div class="six columns">
                                    <input type="text" name="last_name" id="last_name" placeholder="Last name" value="{{ $writer->last_name }}">
                                </div>
                            
                            </div>
                            <div class="row u-full-width">
                                <input type="text" name="username" id="username" placeholder="Username" value="{{ $writer->username }}">
                            </div>
                            <div class="row u-full-width">
                                <input type="email" name="email" id="email" placeholder="Email address" value="{{ $writer->email }}">
                            </div>
                            <div class="row u-full-width">
                                <input type="tel" name="phone" id="phone" placeholder="Phone number" value="{{ $writer->phone }}">
                            </div>
                            <div class="row u-full-width">
                                <textarea name="biography" id="biography" cols="30" rows="10" placeholder="Biography">{{ $writer->biography }}</textarea>
                            </div>
                        
                        </form>
                    
                    </div>
                    
                    <div class="row config_save">
                        <a href="#" class="save_btn">
                            Save
                            
                            <img src="/assets/img/green_arrow.svg" alt="arrow">
                        </a>
                    </div>
                
                </div>
                
                <div class="row config password_config">
                    
                    <div class="row config_title">
                        <span>Change your password</span>
                        <hr>
                    </div>
                    
                    <div class="row content security">
                        
                        <form action="{{ route('writer.password') }}" method="POST">
    
                            @csrf
                            
                            <div class="row u-full-width">
                                <input type="password" name="current_password" id="current_password" placeholder="Current password">
                            </div>
                            <div class="row u-full-width">
                                <input type="password" name="new_password" id="new_password" placeholder="New password*">
                            </div>
                            <div class="row u-full-width">
                                <input type="password" name="retyped_password" id="retyped_password" placeholder="Retype new password*">
                            </div>
                        
                        </form>
                    
                    </div>
                    
                    <div class="row config_save">
                        <a href="#" class="save_btn">
                            Save
                            
                            <img src="/assets/img/green_arrow.svg" alt="arrow">
                        </a>
                    </div>
                
                </div>
            
            </div>
        
        </div>
    
    </section>

@endsection
