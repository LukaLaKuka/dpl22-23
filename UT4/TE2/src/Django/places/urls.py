from django.urls import path

from . import views

app_name = 'places'

urlpatterns = [
    path('', views.index, name='index'),
    path('visited', views.visited, name='visited'),
    path('wished', views.wished, name='index'),
]

