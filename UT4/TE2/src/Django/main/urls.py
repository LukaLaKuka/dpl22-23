from django.contrib import admin
from django.urls import path
from django.urls import include, path

urlpatterns = [
    path('admin/', admin.site.urls),
    # NUEVA LÍNEA ↓
    path('', include('places.urls', 'places')),
]

