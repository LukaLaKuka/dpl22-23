from django.db import models

# Create your models here.

class Place(models.Model):
    name = models.CharField(max_length=255)
    visited = models.BooleanField()

    class Meta:
        # ↓ necesario porque ya partimos de una tabla creada ↓
        db_table = "places"

    def __str__(self):
        return self.name

        