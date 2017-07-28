@extends('layouts.teacher_layouts.profile_layout')

    @section('menu-content')
 
            <!-- Institution's profile information goes here -->
        <div class="container">
    		<form method="POST" action="/teacher/discussion-forum/store">

    		{{ csrf_field() }}
        	<div class="form-group">
       		<label for="DFT_Topic">Post a Question Here:</label>
        	<input type="question" class="form-control" name="DFT_Topic" required>
        	</div>

        	<button type="submit" class="btn btn-primary">Publish Your Question</button>
        	
    		</form>
    	<div>
               <!-- Retrieving the existing topics in the database -->
                                @if($topic->isEmpty())
                                <h4 style="padding: 2%;">No Topic Found</h4>
                                @else
                                @foreach($topic as $top)
                                 <li>
                                     <a href="/teacher/discussion-forum/{{$top->id}}">{{ $top->DFT_Topic }}</a>
                                 </li>
                                 @endforeach
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of content -->

    @endsection